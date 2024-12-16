# Projeto Integrador: Sistema de Gestão de Agendamento para Salão de Beleza

### Curso: Técnico em Informática  
**Professores:** Claudia Tupan, João Marcos Ferlini Bento  
**Aluno:** Gabriel Galieta Baldasso  

## Descrição do Projeto
O projeto consiste no desenvolvimento de uma plataforma digital para otimizar o agendamento de serviços em um salão de beleza, com duas versões: uma versão acessível via web. A plataforma permitirá o gerenciamento de horários, serviços, pagamentos e informações do salão, facilitando a interação entre clientes e profissionais. A versão web utilizará HTML, CSS, PHP e JavaScript para garantir uma experiência interativa e dinâmica.

### Principais Funcionalidades
1. **Cadastro e Login de Usuários:** Registro e autenticação de clientes e profissionais, com segurança de dados.
2. **Gerenciamento de Serviços:** Cadastro de serviços vinculados a profissionais, incluindo preço e tempo de execução.
3. **Agendamento de Serviços:** Clientes podem agendar, visualizar e cancelar serviços com profissionais específicos.
4. **Informações do Salão:** Página "Quem Somos" com horários, localização e integração com Google Maps.
5. **Promoções:** Destaque de promoções e serviços mais requisitados.
6. **Registro de Pagamentos:** Gestão de pagamentos, acompanhando o status dos atendimentos (agendado, cancelado, concluído).
7. **Notificações:** Envio de notificações sobre agendamentos, alterações e cancelamentos.

### Motivação
Muitos salões ainda utilizam métodos tradicionais de agendamento, como WhatsApp e chamadas telefônicas, que são ineficientes e propensos a erros. Este projeto busca oferecer uma solução prática e moderna para aprimorar a experiência dos clientes e facilitar a gestão para os profissionais.

### Objetivos
**Geral:** Desenvolver uma plataforma intuitiva para agendamento e gerenciamento de serviços em um salão de beleza.  
**Específicos:**
- Cadastro e autenticação segura de usuários.
- Gerenciamento de serviços, promoções e pagamentos.
- Melhoria na experiência do usuário com uma interface amigável.
- Integração com mapas para facilitar a localização do salão.

## Requisitos do Sistema
### Requisitos Funcionais (RF)
- **RF001:** Cadastro de clientes com dados como CPF, e-mail e telefone.
- **RF002:** Registro de profissionais com especificação de tipo de serviço.
- **RF003:** Cadastro de serviços com descrição, tempo e preço.
- **RF004:** Registro de atendimentos com status (agendado, cancelado, concluído).
- **RF005:** Exibição de informações do salão e mapa integrado.
- **RF006:** Notificações para clientes e profissionais.
- **RF007:** Histórico de atendimentos para os profissionais.
- **RF008:** Cadastro de tipo profissional (nome e descrição) **(somente administradores ou profissionais podem cadastrar tipos profissionais)**.
- **RF009:** Alteração de tipo profissional (nome e descrição) **(somente administradores podem alterar tipos profissionais)**.
- **RF010:** Exclusão de tipo profissional **(somente administradores podem excluir tipos profissionais)**.
- **RF011:** Cadastro de serviço (nome, descrição e tempo estimado) **(somente profissionais ou administradores podem cadastrar serviços)**.
- **RF012:** Alteração de serviço (nome, descrição e tempo estimado) **(somente administradores podem alterar serviços)**.
- **RF013:** Exclusão de serviço **(somente administradores podem excluir serviços)**.
- **RF014:** Cadastro de atendimento (cliente, tipo de pagamento, preço total, horário inicial e descrição).
- **RF015:** Alteração de atendimento (cliente, tipo de pagamento, preço total, horário inicial e descrição).
- **RF016:** Exclusão de atendimento.
- **RF017:** Vinculação de serviço com profissional (profissional, serviço e preço cobrado pelo serviço) **(somente profissionais ou administradores podem cadastrar vinculações)**.
- **RF018:** Cadastro de tipo de pagamento (nome e descrição) **(somente administradores podem cadastrar tipos de pagamento)**.
- **RF019:** Alteração de tipo de pagamento (nome e descrição) **(somente administradores podem alterar tipos de pagamento)**.
- **RF020:** Exclusão de tipo de pagamento **(somente administradores podem excluir tipos de pagamento)**.
- **RF021:** Alteração do perfil de profissional (nome, descrição e tipo de serviço) **(somente o próprio profissional pode alterar seu perfil)**.

### Requisitos Não Funcionais (RNF)
- **RNF001:** Dados criptografados na autenticação e cadastro de senhas.
- A decidir 

## Escopo do Projeto
O sistema atenderá às seguintes regras de negócio:
- Apenas usuários registrados podem acessar o sistema.
- Serviços devem ser vinculados a profissionais específicos.
- Agendamentos podem ser alterados ou cancelados por clientes e profissionais.
- Pagamentos serão registrados e vinculados aos atendimentos.

## Arquitetura do Sistema
- **Versões:** Web.
- **Design:** Interface responsiva e acessível.
- **Escalabilidade:** Projetado para expansão futura.

## Tecnologias Utilizadas
- Frontend: HTML5, CSS3 e Bootstrap.
- Backend: PHP, JavaScript.
- Banco de Dados: MySQL.

## Contribuição
Sinta-se à vontade para contribuir com o projeto enviando sugestões, relatando bugs ou criando pull requests. Toda ajuda é bem-vinda!

---

**Autor:** Gabriel Galieta Baldasso  
**Curso:** Técnico em Informática  
**Contato:** gabrielgbaldasso@gmail.com  

**Professores Orientadores:** Claudia Tupan, João Marcos Ferlini Bento
