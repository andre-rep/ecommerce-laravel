## Sobre o Ecommerce

O projeto é feito em Laravel 8, trata-se de um site para uma loja local que faz entregas de seus produtos.
Existem dois tipos de contas: Admin e Usuário normal.
Não é possível criar uma nova conta de Admin mas é possível criar uma conta normal para fazer compras.

## Tecnologias utilizadas

Para o backend está sendo utilizado Laravel 8 e Mysql Workbench para gerenciamento do banco de dados. Para o front end está sendo usado Html, Css e Javascript puros além de algumas bibliotecas para funções específicas como Bootstrap 5, Vue.js e Axios para requisições Http.

## Como instalar
É necessário instalar o arquivo "loja.sql" da raíz do projeto para popular o banco de dados já com os usuários cadastrados e vários produtos já disponíveis para compra.
###### Opcional
Para fazer **cadastro de novo usuário** é necessário usar a biblioteca de envio de email do Laravel. Para isso é necessário configurar o arquivo .env com credenciais de um servidor smtp, o seguinte exemplo usa configurações para o gmail:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=endereco@email.com
MAIL_PASSWORD=senhadoemail
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
Você pode colocar em 'MAIL_USERNAME' e em 'MAIL_PASSWORD' as credenciais do seu próprio email, funciona normalmente. Mas por questão de segurança você também pode configurar uma senha de app na sua conta gmail e colocar em 'MAIL_PASSWORD', seguindo o [Tutotial](https://support.google.com/mail/answer/185833?hl=pt-BR), funciona da memsa maneira.

## Login como Admin

Admin já cadastrado\
login: admin@admin.com
senha: 123456789

## Login como Usuário Comum

Usuário já cadastrado\
login: user@user.com
senha: 123456789

## Banco de dados

O Banco de dados relacional foi feito com restrições para ligar as chaves extrangeiras das tabelas quando necessário.

![alt text](http://andrenascimento.com/external_images/banco_de_dados.png)

## Imagens do site

###### Página principal

![alt text](http://andrenascimento.com/external_images/pagina_principal.png)
![alt text](http://andrenascimento.com/external_images/pagina_principal_2.png)

###### Painel de Admin

![alt text](http://andrenascimento.com/external_images/painel_admin.png)

###### Painel de Controle do Usuário Comum

![alt text](http://andrenascimento.com/external_images/painel_de_controle_usuario_comum.png)

###### Produto

![alt text](http://andrenascimento.com/external_images/produto.png)
![alt text](http://andrenascimento.com/external_images/produto_2.png)

## O que ainda falta ser implementado

A página principal ainda conta com alguns links que estão incompletos como os do nav logo a baixo da barra superior, os demais estão funcionais na mesma página.
Ainda falta corrigir um erro na página de pesquisa, os filtros no lado direito da página não estão funcionando corretamente. O erro principal é que, apesar de ser possível filtrar uma pesquisa a desmarcação de uma opção de filtro não está funcionando.
