# NewsLetter

Criado para que o usuário possa criar boletins de noticias e envia-los pelo mundo de uma forma digital.

Desenvolvido com Lavavel 5 - https://laravel.com/docs/5.0

## Instalação 

- Deve ter o composer instalado em seu computador 
https://getcomposer.org/

- Utilizar o xampp com php versao 5.6.40
https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/5.6.40/xampp-windows-x64-5.6.40-1-VC11-installer.exe/download

- Git clone do projeto na pasta xampp/htdocs

- Executar o comando a seguir dentro da pasta do projeto para instalar as bibliotécas nescessárias:

```sh
composer update
```

- Acessar o phpmyadmim
http://localhost/phpmyadmin/index.php

- Criar base de dados
> nome: newsletter \
> agrupamento: utf8_general_ci

- Rodar as migrations com o comando:
```sh
php artisan migrate
````
