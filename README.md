<h1 align="center">Ecommerce Laravel</h1>
<p align="center">Um projeto de ecommerce para uma loja de eletrônicos</p>

<h4 align="center"> 
	🚧  Laravel 🚀 Em construção...  🚧
</h4>

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Laravel](https://laravel.com/) na versão 8, [Mysql Workbench](https://www.mysql.com/products/workbench/), [PHP](https://www.php.net/).
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)

### 🎲 Rodando o Back End (servidor)

```bash
# Clone este repositório
$ git clone <https://github.com/andre-rep/ecommerce-laravel>

# Acesse a pasta do projeto no terminal/cmd
$ cd ecommerce-laravel

# Instale as dependências
$ composer install

# Abra o arquivo .env para editar as credenciais de acesso ao seu servidor workbench
$ nano .env

# Renomeie o arquivo .env.example para .env
$ mv .env.example .env

# Envie os dados da aplicação para o workbench
$ php artisan migrate --seed

# Crie um link da pasta storage para uma pasta dentro da pasta public
$ php artisan storage:link

# Inicie o servidor
$ php artisan serve

# O servidor inciará na porta:8000 - acesse <http://localhost:8000>
```

### Fazer login na aplicação
Login como admin

login: admin@admin.com\
password: 12345

Login como usuário normal

login: user@user.com\
password: 12345

### Opcional

Para **registrar um novo usuário** é necessário usar a biblioteca de email do Laravel. Para isso configure o seu arquivo .env com as credenciais do seu servidor SMTP. Um exemplo de configuração do servidor do gmail:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=address@email.com
MAIL_PASSWORD=emailpassword
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
Substitua 'MAIL_USERNAME' pelo seu username do gmail e 'MAIL_PASSWORD' pela a sua senha do gmail. Caso não queira usar sua senha do gmail, você pode criar uma senha alternativa apenas para essa aplicação, siga o tutorial para isso: [Tutotial](https://support.google.com/mail/answer/185833?hl=pt-br).

### 🛠 Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:

- [Laravel](https://laravel.com/)
- [Mysql Workbench](https://www.mysql.com/products/workbench/)
- [Html](https://developer.mozilla.org/pt-BR/docs/Web/HTML)
- [Css](https://developer.mozilla.org/pt-BR/docs/Web/CSS)

### Imagens da aplicação

###### Página principal

![Página principal](https://raw.githubusercontent.com/andre-rep/laravel-ecommerce-project/master/public/andre-rep/main-page-1.png)
![Página principal](https://raw.githubusercontent.com/andre-rep/laravel-ecommerce-project/master/public/andre-rep/main-page-2.png)

###### Página de Administrador

![Página de Administrador](https://raw.githubusercontent.com/andre-rep/laravel-ecommerce-project/master/public/andre-rep/admin-panel.png)

###### Página de usuário normal

![Página de usuário normal](https://raw.githubusercontent.com/andre-rep/laravel-ecommerce-project/master/public/andre-rep/user-panel.png)

###### Página de produto

![Página de produto](https://raw.githubusercontent.com/andre-rep/laravel-ecommerce-project/master/public/andre-rep/product-page.png)

###### Banco de dados relacional

![Eer Diagram](https://raw.githubusercontent.com/andre-rep/laravel-ecommerce-project/master/public/andre-rep/eer-diagram.png)

### Autor
---

<a href="https://github.com/andre-rep">
 <img style="border-radius:50px;" src="https://avatars.githubusercontent.com/u/36203075?v=4" width="100px;" alt=""/>
 <br />
 <sub><b>André Nascimento</b></sub></a> <a href="https://github.com/andre-rep" title="Github">🚀</a>


Feito com ❤️ por André Nascimento