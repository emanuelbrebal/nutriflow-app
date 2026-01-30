# 🥗 Nutriflow

> SAAS que tem como foco acompanhamento de protocolos de dieta de forma inteligente, utilizando uma abordagem Data-driven (orientado a dados). O sistema conta com módulos para nutricionistas (anamnese, planner, mini ERP) e uma interface para pacientes com geração de insights via IA para maior adesão.

### 💻 Sobre o Projeto

Este projeto nasceu da observação de uma lacuna no mercado de nutrição: a desconexão entre o planejamento dietético e a execução real pelo paciente. Planilhas de Excel e PDFs estáticos dificultam a adesão e o feedback.

O **Nutriflow** resolve isso centralizando a gestão. Para o **Nutricionista**, é uma ferramenta de produtividade e gestão (Mini ERP). Para o **Paciente**, é um companheiro digital que transforma dados de refeições em insights de progresso, utilizando Inteligência Artificial para motivar e ajustar rotas.

---

### 🛠 Tecnologias Utilizadas

O projeto foi desenvolvido utilizando a stack **TALL/VALL** (focada em Monólito Modular):

- **Back-end:** PHP 8.2, Laravel 10.
- **Front-end:** Vue.js 3, Shadcn, Inertia.js (para SPA monolítica), Tailwind CSS.
- **Banco de Dados:** PostgreSQL.
- **Infra/Outros:** Docker, OpenAI API (para insights), Chart.js (gráficos).

---

### ✨ Funcionalidades (Use Cases)

#### 🍎 Módulo Nutricionista
- [x] **Gestão de Pacientes (Mini ERP):** Cadastro completo, histórico de consultas e controle financeiro básico.
- [x] **Anamnese Personalizável:** Criação de formulários de anamnese dinâmicos para coleta de dados de saúde.
- [x] **Planner de Dietas Inteligente:** Interface "drag-and-drop" para montagem de cardápios com cálculo automático de macro/micronutrientes.
- [ ] **Biblioteca de Alimentos:** Consumo da API Webdiet para seleção de alimentos e cálculos de calorias e quantidades.

#### 👤 Módulo Paciente
- [x] **Diário Alimentar:** Registro fácil das refeições realizadas vs. planejadas.
- [x] **Dashboard de Progresso:** Visualização gráfica de evolução de peso, medidas e adesão à dieta.
- [x] **Insights via IA:** O sistema analisa o diário e gera feedbacks automáticos (ex: "Você bateu sua meta de proteínas 5 dias seguidos, parabéns!").
- [ ] **Gerar relatórios PDF:** O paciente e o nutricionista podem gerar relatórios periódicos do acompanhamento do seu protocolo de dietas.


---

### 🧠 O que eu aprendi

Durante o desenvolvimento deste SaaS, aprimorei conhecimentos cruciais:

1. **[Arquitetura Multi-tenant]:** O desafio de isolar dados de diferentes nutricionistas e seus respectivos pacientes dentro do mesmo banco de dados.
2. **[Complexidade de Domínio]:** Modelar dados nutricionais (alimentos, porções, substituições) exigiu um banco de dados relacional robusto e bem planejado.
3. **[Inertia.js]:** Aprendi a construir uma Single Page Application (SPA) mantendo a produtividade do Laravel, sem a necessidade de criar uma API REST separada para o front-end web.
4. **[Integração com LLMs]:** Como estruturar prompts para a IA analisar dados json de refeições e devolver feedbacks humanizados e motivadores.

---

### 🚀 O que pode ser melhorado

- [ ] Implementar integração com Gateway de Pagamentos (Stripe/Asaas) para assinaturas dos nutricionistas.
- [ ] Desenvolver um App Mobile nativo (React Native) para facilitar o input de dados pelo paciente.
- [ ] Desenvolver análise de calorias por foto da refeição.
- [ ] Melhorar a acessibilidade (WCAG) nos relatórios gerados.

---

### 📦 Como rodar o projeto

Este projeto utiliza **Laravel** com **Docker** (Laravel Sail) para facilitar o ambiente de desenvolvimento.

```bash
# 1. Clone o repositório
$git clone [https://github.com/emanuelbrebal/nutriflow.git$](https://github.com/emanuelbrebal/nutriflow.git$) cd nutriflow

# 2. Instale as dependências de Backend e Frontend
$ composer install
$ npm install

# 3. Configure o ambiente
$ cp .env.example .env
# Ajuste as credenciais de banco no .env se não for usar o Docker padrão

# 4. Gere a chave da aplicação
$ php artisan key:generate

# 5. Rode as migrações e Seeds (Popula o banco com dados iniciais)
$ ./vendor/bin/sail artisan migrate --seed

# 6. Compile os assets do Front-end (em outro terminal)
$ npm run dev

O projeto estará acessível em: http://localhost
```
Feito por Emanuel Victor 
