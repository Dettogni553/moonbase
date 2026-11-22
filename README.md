#  MoonBase

Site sobre a **Lua**, feito como trabalho final da disciplina de **Desenvolvimento Web** (HTML, CSS, JavaScript e PHP).

O MoonBase é um espaço para quem gosta de observar o céu noturno: reúne curiosidades sobre a Lua, mostra a fase lunar do dia, tem uma galeria de fotos e um formulário de contato com banco de dados.

## Funcionalidades

- **Página inicial** com texto de apresentação, vídeo de fundo, curiosidade sobre a Lua que muda sozinha a cada 8 segundos e a **fase da Lua de hoje**, calculada em JavaScript.
- **Galeria de fotos** com *lightbox* (a foto abre ampliada ao clicar).
- **Formulário de contato** com validação em JavaScript e gravação das mensagens em um banco MySQL.
- **CRUD de mensagens em PHP (PDO):** cadastrar, listar, editar e excluir.
- **Layout responsivo**, que se adapta a computador e celular.

## Tecnologias

| Tecnologia | Uso no projeto |
|---|---|
| HTML5 | Estrutura das páginas, tags semânticas e formulários |
| CSS3 | Estilo, CSS Grid, efeitos visuais e `@media queries` |
| JavaScript | Fase da Lua, curiosidades, lightbox e validação do formulário |
| PHP 8 + PDO | Conexão com o banco e CRUD de mensagens |
| MySQL | Banco de dados `moonbase` |

## Estrutura do projeto

```
moonbase/
├── img/
│   └── fundo.mp4        # vídeo de fundo
├── index.html           # página inicial
├── contato.php          # formulário de contato (Create)
├── mensagens.php        # lista de mensagens (Read e Delete)
├── editar.php           # edição de mensagem (Update)
├── conexao.php          # conexão com o banco via PDO
├── banco.sql            # script para criar o banco e a tabela
├── script.js            # JavaScript da página inicial
├── contato.js           # validação do formulário de contato
└── style.css            # estilos do site
```

## Como executar

O PHP precisa de um servidor local. Os passos abaixo usam o **XAMPP**:

1. Instale o [XAMPP](https://www.apachefriends.org) e, no painel de controle, inicie o **Apache** e o **MySQL**.
2. Copie a pasta do projeto para `C:\xampp\htdocs\` com o nome `moonbase`.
3. Abra o phpMyAdmin em `http://localhost/phpmyadmin`, vá na aba **SQL**, cole o conteúdo do arquivo `banco.sql` e clique em **Executar**. Isso cria o banco `moonbase` e a tabela `mensagens`.
4. Acesse no navegador:
   - `http://localhost/moonbase/index.html` para a página inicial;
   - `http://localhost/moonbase/contato.php` para o formulário de contato;
   - `http://localhost/moonbase/mensagens.php` para ver, editar e excluir as mensagens.

A conexão usa o usuário `root` e senha vazia, que é a configuração padrão do XAMPP. Se o seu MySQL tiver outra configuração, ajuste o arquivo `conexao.php`.

> A página inicial (`index.html`) funciona abrindo o arquivo direto no navegador. As páginas `.php` só funcionam pelo `localhost`, com o Apache ligado.

## Banco de dados

Tabela `mensagens`:

| Coluna | Tipo | Descrição |
|---|---|---|
| `id` | INT, chave primária | Identificador da mensagem |
| `nome` | VARCHAR(100) | Nome de quem enviou |
| `email` | VARCHAR(150) | E-mail de quem enviou |
| `mensagem` | TEXT | Texto da mensagem |
| `criado_em` | TIMESTAMP | Data e hora do envio |

## Observações

- O PHP valida os dados no servidor e usa consultas preparadas (`prepare` e `execute`) em todas as operações com o banco.
- As fotos da galeria e o logo são carregados por link de sites externos (Pexels e Vexels), então é preciso ter internet para vê-los.
