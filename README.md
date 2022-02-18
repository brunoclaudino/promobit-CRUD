# promobit-CRUD
 Desafio técnico passado pela empresa promobit

 # Atenção
 Projeto apartir da pasta '/crud'.
 ## Database
 O nome do database está definido como 'promobit'. Caso deseje mudar as configurações de DB, configure no arquivo app\Db\Database.php
## Para realizar o login:
Crie uma tabela com o nome 'access' contendo id, login e senha como campos normais de texto. Preencha com o login e senha desejados.

### Exemplo de tabela

CREATE TABLE `access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
);

### Alternativa
Caso não seja do gosto passar por essa parte de login, é possível navegar diretamente para a página 'localhost/crud/produtos.php'. A autenticação de login nas demais paginas não foi feita propositalmente para não limitar a forma de uso do CRUD dependendo de mudanças no banco de dados.

# Dúvidas?
Email:brunoclaudinomatias@gmail.com
linkedIn:https://www.linkedin.com/in/brunoclaudino/
