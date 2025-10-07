<?php
return [
    'app.siteName' => 'Mapa da Cultura',
    'app.siteDescription' => 'O Mapas Culturais é uma plataforma livre para mapeamento cultural.',

    "module.FAQ" => [
        'support-message' => 'Não encontrou o que procurava? Entre em contato com o suporte por meio do canal <a href="mailto:suporte.mapa@cultura.gov.br" style="color: #00a2f0; display: inline;">suporte.mapa@cultura.gov.br</a>.',
    ],

    'mailer.templates' => [
        'welcome' => [
            'title' => "Bem-vindo(a) ao Mapa da Cultura",
            'template' => 'welcome.html'
        ],
        'last_login' => [
            'title' => "Acesse o Mapa da Cultura",
            'template' => 'last_login.html'
        ],
        'new' => [
            'title' => "Novo registro",
            'template' => 'new.html'
        ],
        'update_required' => [
            'title' => "Acesse o Mapa da Cultura",
            'template' => 'update_required.html'
        ],
        'compliant' => [
            'title' => "Denúncia - Mapa da Cultura",
            'template' => 'compliant.html'
        ],
        'suggestion' => [
            'title' => "Mensagem - Mapa da Cultura",
            'template' => 'suggestion.html'
        ],
        'seal_toexpire' => [
            'title' => "Selo Certificador Expirando",
            'template' => 'seal_toexpire.html'
        ],
        'seal_expired' => [
            'title' => "Selo Certificador Expirado",
            'template' => 'seal_expired.html'
        ],
        'opportunity_claim' => [
            'title' => "Solicitação de Recurso de Oportunidade",
            'template' => 'opportunity_claim.html'
        ],
        'request_relation' => [
            'title' => "Solicitação de requisição",
            'template' => 'request_relation.html'
        ],
        'start_registration' => [
            'title' => "Inscrição iniciada",
            'template' => 'start_registration.html'
        ],
        'start_data_collection_phase' => [
            'title' => "Sua inscrição avaçou de fase",
            'template' => 'start_data_collection_phase.html'
        ],
        'export_spreadsheet' => [
            'title' => "Arquivo gerado",
            'template' => 'export_spreadsheet.html'
        ],
        'send_registration' => [
            'title' => "Inscrição enviada",
            'template' => 'send_registration.html'
        ],
        'claim_form' => [
            'title' => "Solicitação de recurso",
            'template' => 'claim_form.html'
        ],
        'claim_certificate' => [
            'title' => "Certificado de solicitação de recurso",
            'template' => 'claim_certificate.html'
        ],
    ],

    # METABASE
    'Metabase' => [
        'config' => [
            'links' => [
                'painel-agentes' => [
                    'link' => env('METABASE_MINC_AGENT_PANEL', null), // dashboard dos agentes
                    'text' => 'Agentes Culturais',
                    'title' => 'Agentes Culturais',
                    'entity' => 'Agent'
                ],
                'painel-espacos' => [
                    'link' => env('METABASE_MINC_SPACE_PANEL', null), // dashboard dos espaços
                    'text' => 'Saiba os números de espaços cadastrados, quantos são criados mensalmente, por onde estão distribuídos no território e outras informações.',
                    'title' => 'Painel sobre espaços',
                    'entity' => 'Space'
                ],
                'painel-oportunidades' => [
                    'link' => env('METABASE_MINC_OPPORTUNITY_PANEL', null), //dashboard das oportunidade
                    'text' => 'Ações Culturais e Instrumentos de Fomento',
                    'title' => 'Ações Culturais e Instrumentos de Fomento',
                    'entity' => 'Opportunity'
                ],
            ],
            'cards' => [
                'home' => [
                    [
                        'type' => 'space',
                        'label' => '',
                        'icon' => 'space',
                        'iconClass' => 'space__color',
                        'panelLink' => 'painel-espacos',
                        'data' => [
                            [
                                'icon' => 'space',
                                'label' => 'Espaços cadastrados',
                                'entity' => 'MapasCulturais\\Entities\\Space',
                                'query' => [],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'space',
                        'label' => '',
                        'icon' => 'space',
                        'iconClass' => 'space__color',
                        'panelLink' => 'painel-espacos',
                        'data' => [
                            [
                                'icon' => 'space',
                                'label' => 'Espaços certificados',
                                'entity' => 'MapasCulturais\\Entities\\Space',
                                'query' => [
                                    '@verified' => 1
                                ],
                                'value' => null
                            ]
                        ]
                    ],
                    [
                        'type' => 'agent',
                        'label' => '',
                        'icon' => 'agent',
                        'iconClass' => 'agent__color',
                        'panelLink' => 'painel-agentes',
                        'data' => [
                            [
                                'icon' => 'agent',
                                'label' => 'Agentes cadastrados',
                                'entity' => 'MapasCulturais\\Entities\\Agent',
                                'query' => [],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'agent',
                        'label' => '',
                        'icon' => 'agent',
                        'iconClass' => 'agent__color',
                        'panelLink' => 'painel-agentes',
                        'data' => [
                            [
                                'icon' => 'agent',
                                'label' => 'Agentes individuais',
                                'entity' => 'MapasCulturais\\Entities\\Agent',
                                'query' => ['type' => 'EQ(1)'],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'agent',
                        'label' => '',
                        'icon' => 'agent',
                        'iconClass' => 'agent__color',
                        'panelLink' => 'painel-agentes',
                        'data' => [
                            [
                                'icon' => 'agent',
                                'label' => 'Agentes coletivos',
                                'entity' => 'MapasCulturais\\Entities\\Agent',
                                'query' => ['type' => 'EQ(2)'],
                                'value' => null
                            ],
                        ]
                    ],
                    // opportunity
                    [
                        'type' => 'opportunity',
                        'label' => 'Oportunidades',
                        'icon' => 'opportunity',
                        'iconClass' => 'opportunity__color',
                        'panelLink' => 'painel-oportunidades',
                        'data' => [
                            [
                                'label' => 'Oportunidades criadas',
                                'entity' => 'MapasCulturais\\Entities\\Opportunity',
                                'query' => [],
                                'value' => null
                            ],
                            [
                                'label' => 'Oportunidades certificadas',
                                'entity' => 'MapasCulturais\\Entities\\Opportunity',
                                'query' => [
                                    '@verified' => 1
                                ],
                                'value' => null
                            ],
                        ]
                    ]

                ],
                'entities' => [
                    [
                        'type' => 'space',
                        'label' => '',
                        'icon' => 'space',
                        'iconClass' => 'space__color',
                        'panelLink' => 'painel-espacos',
                        'data' => [
                            [
                                'id' => 'espacos-cadastrados',
                                'icon' => 'space',
                                'label' => 'Espaços cadastrados',
                                'entity' => 'MapasCulturais\\Entities\\Space',
                                'query' => [],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'space',
                        'label' => '',
                        'icon' => 'space',
                        'iconClass' => 'space__color',
                        'panelLink' => 'painel-espacos',
                        'data' => [
                            [
                                'id' => 'espacos-certificados',
                                'icon' => 'space',
                                'label' => 'Espaços certificados',
                                'entity' => 'MapasCulturais\\Entities\\Space',
                                'query' => [
                                    '@verified' => 1
                                ],
                                'value' => null
                            ]
                        ]
                    ],
                    [
                        'type' => 'agent',
                        'label' => '',
                        'icon' => 'agent',
                        'iconClass' => 'agent__color',
                        'panelLink' => 'painel-agentes',
                        'data' => [
                            [
                                'id' => 'agentes-cadastrados',
                                'icon' => 'agent',
                                'label' => 'Agentes cadastrados',
                                'entity' => 'MapasCulturais\\Entities\\Agent',
                                'query' => [],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'agent',
                        'label' => '',
                        'icon' => 'agent',
                        'iconClass' => 'agent__color',
                        'panelLink' => 'painel-agentes',
                        'data' => [
                            [
                                'id' => 'agentes-individuais',
                                'icon' => 'agent',
                                'label' => 'Agentes individuais',
                                'entity' => 'MapasCulturais\\Entities\\Agent',
                                'query' => ['type' => 'EQ(1)'],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'agent',
                        'label' => '',
                        'icon' => 'agent',
                        'iconClass' => 'agent__color',
                        'panelLink' => 'painel-agentes',
                        'data' => [
                            [
                                'id' => 'agentes-coletivos',
                                'icon' => 'agent',
                                'label' => 'Agentes coletivos',
                                'entity' => 'MapasCulturais\\Entities\\Agent',
                                'query' => ['type' => 'EQ(2)'],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'agent',
                        'label' => '',
                        'icon' => 'agent',
                        'iconClass' => 'agent__color',
                        'panelLink' => 'painel-agentes',
                        'data' => [
                            [
                                'id' => 'agentes-cadastrados-7-dias',
                                'icon' => 'agent',
                                'label' => 'Cadastrados nos últimos 7 dias',
                                'entity' => 'MapasCulturais\\Entities\\Agent',
                                'query' => [
                                    '@select' => 'createTimestamp'
                                ],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'opportunity',
                        'label' => 'Oportunidades',
                        'icon' => 'opportunity',
                        'iconClass' => 'opportunity__color',
                        'panelLink' => 'painel-oportunidades',
                        'data' => [
                            [
                                'icon' => 'opportunity',
                                'label' => 'Oportunidades criadas',
                                'entity' => 'MapasCulturais\\Entities\\Opportunity',
                                'query' => [],
                                'value' => null
                            ],
                        ]
                    ],
                    [
                        'type' => 'opportunity',
                        'label' => 'Oportunidades certificadas',
                        'icon' => 'opportunity',
                        'iconClass' => 'opportunity__color',
                        'panelLink' => 'painel-oportunidades',
                        'data' => [
                            [
                                'icon' => 'opportunity',
                                'label' => 'Oportunidades certificadas',
                                'entity' => 'MapasCulturais\\Entities\\Opportunity',
                                'query' => [
                                    '@verified' => 1
                                ],
                                'value' => null
                            ],
                        ]
                    ]
                ]
            ]
        ]
    ],

    # AUTENTICAÇÃO
    'auth.provider' => '\MultipleLocalAuth\Provider',
    'auth.config' => [
        'salt' => env('AUTH_SALT', 'SECURITY_SALT'),
        'wizard' => env('AUTH_WIZARD_ENABLED', false),
        'timeout' => '24 hours',
        'strategies' => [
            'govbr' => [
                'visible' => env('AUTH_GOV_BR_VISIBLE', false),
                'response_type' => env('AUTH_GOV_BR_RESPONSE_TYPE', 'code'),
                'client_id' => env('AUTH_GOV_BR_CLIENT_ID', null),
                'client_secret' => env('AUTH_GOV_BR_SECRET', null),
                'scope' => env('AUTH_GOV_BR_SCOPE', null),
                'redirect_uri' => env('AUTH_GOV_BR_REDIRECT_URI', null), 
                'auth_endpoint' => env('AUTH_GOV_BR_ENDPOINT', null),
                'token_endpoint' => env('AUTH_GOV_BR_TOKEN_ENDPOINT', null),
                'nonce' => env('AUTH_GOV_BR_NONCE', null),
                'code_verifier' => env('AUTH_GOV_BR_CODE_VERIFIER', null),
                'code_challenge' => env('AUTH_GOV_BR_CHALLENGE', null),
                'code_challenge_method' => env('AUTH_GOV_BR_CHALLENGE_METHOD', null),
                'userinfo_endpoint' => env('AUTH_GOV_BR_USERINFO_ENDPOINT', null),
                'state_salt' => env('AUTH_GOV_BR_STATE_SALT', null),
                'applySealId' => env('AUTH_GOV_BR_APPLY_SEAL_ID', null),
                'menssagem_authenticated' => env('AUTH_GOV_BR_MENSSAGEM_AUTHENTICATED','Usuário já se autenticou pelo GovBr'),
                'dic_agent_fields_update' => json_decode(env('AUTH_GOV_BR_DICT_AGENT_FIELDS_UPDATE', '{}'), true)
            ]
        ]
    ]
];
