# Manual de Uso: Módulo Basic Intelipost

[![logo](https://image.prntscr.com/image/E8AfiBL7RQKKVychm7Aubw.png)](http://www.intelipost.com.br)

## Introdução

O módulo Basic é responsável por criar a estrutura de apoio para todos os outros módulos da Intelipost.

É um módulo excepcionalmente de configurações.

Este manual foi divido em duas partes:

  - [Instalação](#instalação): Onde você econtrará instruções para instalar nosso módulo.
  - [Configurações](#configurações): Onde você encontrará o caminho para realizar as configurações e explicações de cada uma delas.

-----
## Instalação
> É recomendado que você tenha um ambiente de testes para validar alterações e atualizações antes de atualizar sua loja em produção.

> A instalação do módulo é feita utilizando o Composer. Para baixar e instalar o Composer no seu ambiente acesse https://getcomposer.org/download/ e caso tenha dúvidas de como utilizá-lo consulte a [documentação oficial do Composer](https://getcomposer.org/doc/).

Navegue até o diretório raíz da sua instalação do Magento 2 e execute os seguintes comandos:

```
composer require intelipost/magento2-basic   // Faz a requisição do módulo da Intelipost
bin/magento module:enable Intelipost_Basic       // Ativa o módulo
bin/magento setup:upgrade                        // Registra a extensão
bin/magento setup:di:compile                     // Recompila o projeto Magento
```
-----

## Configurações
Para acessar a área de configurações, basta seguir os passos a baixo:

No menu à esquerda, acessar **Stores** -> **Configuration** -> **Intelipost** -> **Basic**:

![b1](https://s3.amazonaws.com/email-assets.intelipost.net/integracoes/b1.gif)

#### URL da API:
Deve ser preenchido com o endereço base para a integração.
Atualmente é utilizado: https://api.intelipost.com.br/api/v1/

#### Chave da API:
Deve ser preenchido com a chave de autenticação fornecida pela equipe Intelipost.
Caso não tenha uma, entre em contato conosco no e-mail integracoes@intelipost.com.br.
