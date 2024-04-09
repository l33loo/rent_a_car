# SISTEMA DE RESERVAS PARA RENT-A-CAR

## ENQUADRAMENTO

A empresa local FAMILY RENT pretende implementar um sistema de reservas online para suporte ao seu
negócio de rent-a-car familiar em São Miguel, que actualmente é feito por email ou por telefone, o que
está a ser muito prejudicial à empresa pois os seus concorrentes todos permitem reservas na hora
online.

A empresa actualmente apenas presta serviços de aluguer na ilha de São Miguel, nos vários concelhos,
mas no próximo ano civil a empresa tem já em construção uma nova localização na ilha vizinha de Santa
Maria.

A aplicação a desenvolver para além de serviço de rent-a-car deverá servir de website institucional da
empresa, mostrando aos visitantes informação sobre a história, contactos, localizações, etc.
O serviço de aluguer propriamente dito deverá permitir reservas com ou sem sessão iniciada, não
obrigando os clientes a criar uma conta, mas caso o pretendam fazer deve existir esta opção. As
reservas devem ser realizadas por localização, data de recolha e entrega, e categoria da viatura.
As viaturas da empresa dividem-se em categorias, cada uma com um preço diário diferente, pelo que
será necessário um perfil de administrador capaz de gerir categorias, preços e viaturas, sendo que cada
categoria pode ter várias viaturas disponíveis. Apenas podem ser feitas reservas, se houver viaturas
disponíveis na localização e categoria escolhida, durante a totalidade do período de aluguer.

## REQUISITOS

### RF1 – GESTÃO DE UTILIZADORES

O sistema contará com um perfil de administrador e cliente, em que os clientes apenas podem fazer e
gerir as suas reservas, e os administradores podem gerir e consultar as frotas, reservas e utilizadores da
aplicação.

Apenas é permitido registo de utilizadores com perfil cliente, via formulário. O registo de
administradores é apenas feito por outros administradores, sendo que aos administradores também
será disponibilizada a funcionalidades de CRUD de clientes.

#### NOTES:

Classes:
- Cliente
- Administrador
- Utilizador
- Frota
- Viatura
    - Tipos de viatura
- Localizacao
- Reserva

### RF2 – GESTÃO DE LOCALIZAÇÕES

As localizações da empresa são os locais em que é possível recolher ou entregar carros, e tendo em
conta a possibilidade de abertura ou fecho de localizações as mesmas devem ser parametrizáveis e
geridas pelos utilizadores com perfil de administração.

### RF3 – GESTÃO DE FROTA

Entende-se por frota o conjunto de viaturas disponíveis para aluguer, dividas pelas várias categorias.
Como as categorias podem ser alteradas é necessário que os administradores possam adicionar,
remover ou modificar categorias.

As viaturas devem ter características que permitam aos clientes rapidamente escolher qual o carro
pretendido, tais como e não só:
• Número de passageiros da viatura
• Combustível
• Número de malas que consegue transportar
• Viatura conhecida similar à mesma (Renault Clio)

### RF4 – RESERVAS

O processo de reservas é o objectivo principal do desenvolvimento, e por isso deve ser garantido que
corresponde na integra às necessidades do cliente.
As reservas podem ser feitas via website por utilizadores registados ou visitantes, mas também por
qualquer administrador da aplicação.

Uma reserva tem que obrigatoriamente ter os seguintes elementos, e outros que sejam considerados
como pertinentes:
• Localização de Recolha
• Localização de Entrega
• Data e hora de Início previsto
• Data e hora de Fim previsto
• Data e hora de início efectiva
• Data e hora de fim efectiva
• Viatura atribuída
• Cliente com todos os dados de contacto, bem como número da carta de condução e cartão de
crédito.

Apenas é possível modificar reservas aos administradores do sistema, os clientes podem efectuar o
pedido de alteração por email ou directamente no portal se forem utilizadores registados, mas terá que
ser um administrador a aprovar ou não o pedido.

### RF5 – INFORMAÇÃO INSTITUCIONAL

Para além de servir de sistema de reservas para a empresa FAMILYRENT a aplicação a desenvolver
deverá ter um conjunto de páginas estáticas para apresentação de informação institucional da empresa.

### RF6 – PERSISTENCIA DE DADOS

Para segurança e rapidez, a informação deve ser guardada numa base de dados MySQL e acedida
sempre que necessário.

##   METODOLOGIA DE DESENVOLVIMENTO

A interface web de qualquer aplicação é apenas isto, uma interface, e como tal devem desenvolver os
requisitos e toda a lógica de forma independente da interface, por exemplo, o processo de registo de cliente deve ser implementado recebendo os dados, validando os mesmos, e posteriormente guardar
em base de dados. A interface web, deve invocar este procedimento fornecendo os dados recebidos do
formulário e nada mais.
A vantagem desta metodologia de desenvolvimento é separar as responsabilidades da interface e da
lógica aplicacional, de forma que a interface possa ser completamente alterada sem qualquer
necessidade de mexer na camada aplicacional, e vice-versa.
Assim sendo deve implementar os scripts PHP relevantes para a interface e para a lógica aplicacional em
pastas diferentes, assim como a base de dados.
Toda a aplicação deve utilizar namespaces e autoloading.

## AVALIAÇÃO E ENTREGA

• Trabalho em grupos 2 alunos, se não for possível far-se-á um grupo de 3 alunos
• Entregar até 27 de Maio de 2024 às 23:59 via Moodle
• A entrega deverá ser acompanhada de um relatório descrevendo o projeto em geral, bem
como o diagrama de classes.
• O trabalho será avaliado com os seguintes componentes:
o Relatório e diagrama de classes: 20%
o Apresentação e discussão: 20%
o Aplicação Desenvolvida: 60%
§ Implementação de requisitos: 80%
§ Comentários e regras estilísticas de escrita de código: 20% (https://www.php-
fig.org/psr/psr-2/)