Selecione o idioma: [Inglês](https://github.com/andrenasc25/ecommerce-laravel), **English**
========

<h1 align="center">Ecommerce Laravel</h1>
<p align="center">Um projeto de ecommerce feito em Laravel e Vuejs</p>

<h4 align="center"> 
	🚀 Em construção...  🚧
</h4>

## Sobre o Ecommerce

O projeto é feito em Laravel 8, trata-se de um site para uma loja local que faz entregas de seus produtos.
Existem dois tipos de contas: Admin e Usuário normal.
Não é possível criar uma nova conta de Admin mas é possível criar uma conta normal para fazer compras.

## Tecnologias utilizadas

Para o backend está sendo utilizado Laravel 8 e Mysql Workbench para gerenciamento do banco de dados. Para o front end está sendo usado Html, Css e Javascript puros além de algumas bibliotecas para funções específicas como Bootstrap 5, Vue.js e Axios para requisições Http.

## Como instalar

Após a configuração do arquivo .env basta rodar o comando:
```
php artisan migrate --seed
```
O site já vai estar instalado e populado com alguns produtos e com os dados de um user e um admin.
É necessário também fazer um link entre o storage a pasta storage dentro de public, usando o comando:
```
php artisan storage:link
```

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
Você pode colocar em 'MAIL_USERNAME' e em 'MAIL_PASSWORD' as credenciais do seu próprio email, funciona normalmente. Mas por questão de segurança você também pode configurar uma senha de app na sua conta gmail e colocar em 'MAIL_PASSWORD', seguindo o [Tutorial](https://support.google.com/mail/answer/185833?hl=pt-BR), funciona da mesma maneira.

## Login como Admin

Admin já cadastrado\
login: admin@admin.com\
senha: 12345

## Login como Usuário Comum

Usuário já cadastrado\
login: user@user.com\
senha: 12345

## Banco de dados

O Banco de dados relacional foi feito com restrições para ligar as chaves extrangeiras das tabelas quando necessário.

![Eer Diagram](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/eer-diagram.png)

## Imagens do site

###### Página principal

![Main Page 1](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/main-page-1.png)
![Main Page 2](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/main-page-2.png)

###### Painel de Admin

![Admin Panel](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/admin-panel.png)

###### Painel de Controle do Usuário Comum

![User Panel](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/user-panel.png)

###### Produto

![Product Page](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/product-page.png)

## Erros ainda a serem corrigidos e novas implementações

- A página de pesquisa de produtos possui um filtro do lado direito da página que ainda não está funcionando
- Falta adicionar uma integração para pagamento no final da compra. Atualmente o usuário pode apenas fazer pagamento ao receber o produto.