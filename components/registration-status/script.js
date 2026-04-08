app.component('registration-status', {
    template: $TEMPLATES['registration-status'],

    props: {
        registration: {
            type: Entity,
            required: true
        },

        phase: {
            type: Entity,
            required: true
        }
    },

    setup(props, { slots }) {
        const hasSlot = name => !!slots[name];
        // os textos estão localizados no arquivo texts.php deste componente 
        const text = Utils.getTexts('registration-status');
        return { text, hasSlot }
    },

    data() {
        return {
            processing: false,
            entity: null,
            appealPhaseRegistrationFrom: this.registration.opportunity.appealPhase?.registrationFrom,
            appealPhaseRegistrationTo: this.registration.opportunity.appealPhase?.registrationTo,
            appealPhaseEvaluationFrom: this.registration.opportunity.appealPhase?.evaluationMethodConfiguration.evaluationFrom,
            appealPhaseEvaluationTo: this.registration.opportunity.appealPhase?.evaluationMethodConfiguration.evaluationTo,
        }
    },

    computed: {
        firstPhase() {
            return this.opportunity.parent || this.opportunity;
        },
        firstPhaseRegistration() {
            return $MAPAS.registrationPhases[this.firstPhase.id];
        },
        appealPhase() {
            return this.opportunity.isAppealPhase ? this.opportunity : this.opportunity.appealPhase;
        },

        appealRegistration() {
            const appealPhaseId = this.appealPhase?.id;
            if (!appealPhaseId) {
                return null;
            }

            return $MAPAS.registrationPhases[appealPhaseId] || this.entity;
        },

        canShowAppeal() {
            if (this.registration.opportunity.isReportingPhase) {
                return false;
            }

            if (!this.firstPhaseRegistration.currentUserPermissions.create) {
                return false;
            }

            return this.registration.status > 1 && this.registration.status < 10;
        },

        opportunity() {
            if (this.phase.__objectType === 'evaluationmethodconfiguration') {
                return this.phase.opportunity;
            } else {
                return this.phase;
            }
        },

        // Verifica se o resultado final foi publicado (na última fase)
        isFinalResultPublished() {
            let lastPhase = null;
            
            // Tenta buscar a última fase através das fases disponíveis
            if ($MAPAS.opportunityPhases && Array.isArray($MAPAS.opportunityPhases)) {
                lastPhase = $MAPAS.opportunityPhases.find(phase => phase.isLastPhase);
            }
            
            // Fallback: tenta através da oportunidade base
            if (!lastPhase && this.firstPhase && this.firstPhase.lastPhase) {
                lastPhase = this.firstPhase.lastPhase;
            }
            
            // Se encontrou a última fase, verifica se os resultados foram publicados
            if (lastPhase) {
                // Para fluxo contínuo sem data final, considera publicado apenas se realmente houver publicação
                if (this.firstPhase?.isContinuousFlow && !this.firstPhase?.hasEndDate) {
                    // Em fluxo contínuo sem data final, sempre considera como "em análise" até que seja explicitamente publicado
                    return false;
                }
                return lastPhase.publishedRegistrations === true || lastPhase.publishedRegistrations === '1';
            }
            
            return false;
        },

        showRegistrationResults() {
            const { isReportingPhase, __objectType, publishEvaluationDetails } = this.phase;
            const { allow_proponent_response } = this.registration.opportunity;

            if (isReportingPhase === '1' && __objectType === 'opportunity' && allow_proponent_response == '1') {
                return false;
            }

            return publishEvaluationDetails || allow_proponent_response === '1';
        },

        appealEvaluationPhase() {
            if (!this.appealRegistration) {
                return null;
            }
            return this.appealRegistration.opportunity?.evaluationMethodConfiguration || this.appealRegistration.opportunity;
        },
    },

    methods: {
        formatNote(note) {
            note = parseFloat(note);
            return note.toLocaleString($MAPAS.config.locale);
        },
        verifyState(registration) {
            const phaseOpportunity = this.opportunity;
            const isLastPhase = phaseOpportunity.isLastPhase === true;
            const isPublished = this.isFinalResultPublished;
            
            // Última fase COM publicação final: retorna success se selecionada, caso contrário danger
            if (isLastPhase && isPublished) {
                return registration.status === 10 ? 'success__color' : 'danger__color';
            }

            // Fase intermediária OU última fase sem publicação: 
            // Se publicado -> success (verde), se não publicado -> warning (laranja/amarelo)
            return isPublished ? 'success__color' : 'warning__color';
        },

        showStatus(registration) {
            const phaseOpportunity = this.opportunity;
            const isLastPhase = phaseOpportunity.isLastPhase === true;
            const isPublished = this.isFinalResultPublished;
            

            // Última fase COM publicação final: mostra se foi selecionada ou não
            if (isLastPhase && isPublished) {
                return registration.status === 10 ? 'Inscrição selecionada' : 'Inscrição não selecionada';
            }

            // Fase intermediária OU última fase sem publicação: mostra "Análise Encerrada" ou "Em Análise"
            return isPublished ? 'Análise Encerrada' : 'Em Análise';
        },

        verifyAppealState(appealRegistration) {
            // Para recursos, segue a mesma lógica das fases intermediárias
            return this.isFinalResultPublished ? 'success__color' : 'warning__color';
        },

        showAppealStatus(appealRegistration) {
            // Para recursos, segue a mesma lógica das fases intermediárias
            return this.isFinalResultPublished ? 'Análise Encerrada' : 'Em Análise';
        },

        async createAppealPhaseRegistration() {
            this.processing = true;
            const messages = useMessages();

            const target = this.opportunity;

            const args = {
                registration_id: this.registration._id,
            };

            try {
                await target.POST('createAppealPhaseRegistration', {
                    data: args, callback: (data) => {
                        this.entity = new Entity('registration');
                        this.entity.populate(data);
                        this.processing = false;
                        messages.success(this.text('Solicitação de recurso criada com sucesso'));

                        window.location.href = Utils.createUrl('registration', 'view', [this.entity.id]);
                    }
                });

            } catch (error) {
                console.error(error);
                messages.error(error.data ?? error);
            }
            this.processing = false;
        },

        fillFormButton() {
            window.location.href = this.appealRegistration.editUrl;
        },

        dateFrom() {
            if (this.appealPhaseRegistrationFrom) {
                return this.appealPhaseRegistrationFrom.date('2-digit year');
            }
            if (this.appealPhaseEvaluationFrom) {
                return this.appealPhaseEvaluationFrom.date('2-digit year');
            }
            return false;
        },

        dateTo() {
            if (this.appealPhaseRegistrationTo) {
                return this.appealPhaseRegistrationTo.date('2-digit year');
            }
            if (this.appealPhaseEvaluationTo) {
                return this.appealPhaseEvaluationTo.date('2-digit year');
            }
            return false;
        },

        hour() {
            if (this.appealPhaseRegistrationTo) {
                return this.appealPhaseRegistrationTo.time();
            }
            if (this.appealPhaseEvaluationTo) {
                return this.appealPhaseEvaluationTo.time();
            }
            return false;
        },

        redirectToRegistrationForm() {
            return window.location.hash = "#ficha";
        },

        shouldShowResults(item) {
            // se é uma fase de avaliação que não tem uma fase de coleta de dados anterior
            const isEvaluation = item.__objectType == 'evaluationmethodconfiguration';

            // se é uma fase de coleta de dados que não tem uma fase de avaliação posterior
            const isRegistrationOnly = item.__objectType == 'opportunity' && !item.evaluationMethodConfiguration;

            const phaseOpportunity = item.__objectType == 'opportunity' ? item : item.opportunity;

            return phaseOpportunity.publishedRegistrations && (isRegistrationOnly || isEvaluation);

        },
        showResults(phase) {
            const types = ['qualification', 'technical', 'documentary'];
            return types.includes(phase.type) || phase.publishEvaluationDetails;
        },
    }
});
