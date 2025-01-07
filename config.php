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
    ]
];
