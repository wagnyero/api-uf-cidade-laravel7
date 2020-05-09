<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Sobre a API

Desenvolvimento de uma API REST para cadastrar UFs e cidades. Foi utilizado as seguintes tecnologias abaixo:

- PHP 7.4
- Laravel 7.1
- JWT 1.0.0
- MariaDb
- JSON
- HTTP 1.1


## Processo de instalação

- Fazer uma cópia do arquivo .env.example e salvar como .env
- Criar um vhost em seu servidor para a pasta public do projeto
- Criar um database chamado api_uf_cidade, com charset utf8 e collation utf8_unicode_ci
- Executar o comando php artisan migrate


## Utilização dos EndPoints

- **ENDPOINT - Users**

- Listagem de todos os usuários  
**GET**  http://seuservidor/api/v1/users

- Listagem de um usuário específico  
**GET**  http://seuservidor/api/v1/users/#ID

- Novo Usuário  
**POST**  http://seuservidor/api/v1/users   
**CAMPOS**  
name = nome do usuário  
email = email do usuário  
password = senha do usuário  
password_confirmation = confirmação da senha  

- Alterar Usuário
**PUT**  http://seuservidor/api/v1/users  
**CAMPOS**  
name = nome do usuário  
email = email do usuário  
password = senha do usuário  
password_confirmation = confirmação da senha  

- Excluir Usuário
**DELETE**  http://seuservidor/api/v1/users/#ID_USUARIO  
**CAMPOS**  
#ID_USUARIO = Id do usuário que deseja-se excluir  

- **ENDPOINT - Login**
- Gerar token de acesso a API  
**POST**  http://seuservidor/api/v1/login  
**CAMPOS**  
email = email do usuário  
password = senha do usuário  

**Para utilizar qualquer endpoint é necessário informar o token de acesso no cabeçalho da requisição acrescido da palavra**
**Bearer #token_a_ser_utilizado**

- **ENDPOINT - Country**
- Listagem de todos os Estados  
**GET**  http://seuservidor/api/v1/country  

- Listagem de um estado específico
**GET**  http://seuservidor/api/v1/country/#ID  
**CAMPOS**  
#ID = Id do Estado que deseja-se excluir  

- Busca Personalizada: trazer apenas determinados campos  
**GET**  http://seuservidor/api/v1/country?fields=id,name  
**CAMPOS**  
fields = informar todos os campos que desejar separados por virgula  

- Busca Personalizada: fazer busca parcial usando controladores como: =, >=, <=, like  
**GET**  http://seuservidor/api/v1/country?coditions=name:like:r%;id:>=:10  
**CAMPOS**  
coditions = esse campo recebe todas as condições que desejar fazer, no exemplo acima a api irá retornar todos os estados que iniciam com "r" e que o id seja maior ou igual a 10  

**OBS** É possível fazer a busca parcial informando os dois campos juntos: fields e coditions  

- Novo Estado
**POST**  http://seuservidor/api/v1/country  
**CAMPOS**  
name = nome do estado  

- Alterar Estado
**PUT**  http://seuservidor/api/v1/country  
**CAMPOS**  
name = nome do usuário  

- Excluir Estado  
**DELETE**  http://seuservidor/api/v1/country/#ID  
**CAMPOS**  
#ID = Id do Estado que deseja-se excluir  

- **ENDPOINT - City**
- Listagem de todos as cidades
**GET**  http://seuservidor/api/v1/city  

- Listagem de uma cidade específica
**GET**  http://seuservidor/api/v1/city/#ID  
**CAMPOS**  
#ID = Id da cidade que deseja-se excluir  

- Busca Personalizada: trazer apenas determinados campos  
**GET**  http://seuservidor/api/v1/city?fields=id,name  
**CAMPOS**  
fields = informar todos os campos que desejar separados por virgula  

- Busca Personalizada: fazer busca parcial usando controladores como: =, >=, <=, like  
**GET**  http://seuservidor/api/v1/city?coditions=name:like:%volta%  
**CAMPOS**  
coditions = esse campo recebe todas as condições que desejar fazer, no exemplo acima a api irá retornar todos as cidades que contenham a palavra "volta"  

**OBS** É possível fazer a busca parcial informando os dois campos juntos: fields e coditions  

- Nova Cidade
**POST**  http://seuservidor/api/v1/city  
**CAMPOS**  
name = nome da cidade  
country_id = id do estado que deseja associar  

- Alterar Cidade
**PUT**  http://seuservidor/api/v1/city  
**CAMPOS**  
name = nome da cidade  
country_id = id do estado que deseja associar  

- Excluir Cidade
**DELETE**  http://seuservidor/api/v1/country/#ID  
**CAMPOS**  
#ID = Id da cidade que deseja-se excluir
