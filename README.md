# Tema Bíblia de Homem

Implementação em código do protótipo `Biblia de Homem - Protótipo.dc.html`
(handoff do Claude Design). Tema WordPress clássico, sem dependência de
Elementor — Elementor Pro continua disponível para qualquer página extra que
você queira montar visualmente (ex: "Comece Aqui", "Homens de Honra"), mas as
5 telas desenhadas no protótipo são código fixo, leve e rápido (sem JS de
detecção de tela: a responsividade é só CSS/media query, o que é melhor para
Core Web Vitals do que recalcular layout em JS).

## Instalação

1. Copie a pasta `biblia-de-homem` para `wp-content/themes/` no seu site
   (via FTP/File Manager da Hostinger, ou `wp-content/themes/biblia-de-homem`
   já é a estrutura certa neste repositório).
2. Em **Aparência → Temas**, ative "Bíblia de Homem".
3. Em **Configurações → Links Permanentes**, escolha qualquer opção
   "bonita" (ex: Nome do post) e salve — isso ativa as URLs de
   `/papel/marido/` etc.

## Configurar as páginas

O tema ativa automaticamente as categorias **Devocionais** e **Ensinamentos**,
e os 4 papéis (**Marido, Pai, Filho, Sacerdote**) com suas subcategorias, na
primeira vez que o tema carrega (`init`).

1. **Páginas → Adicionar Nova** → título "Devocionais" → no painel direito,
   em **Modelo**, escolha **Devocionais** → Publicar.
2. Repita para uma página "Ensinamentos" com o modelo **Ensinamentos**.
3. Em **Configurações → Leitura**, defina "Sua página inicial mostra" →
   **Uma página estática** não é necessário: a Home já é renderizada
   automaticamente por `front-page.php`.

## Publicando um devocional (a parte que você disse ser cansativa)

`Posts → Adicionar Novo`:

1. Escreva o título e o texto normalmente.
2. Marque a categoria **Devocionais**.
3. Role até o box **"Bíblia de Homem — Detalhes do Post"** (abaixo do
   editor) e preencha **"Dia do devocional"** (1–365). Isso já faz o post
   aparecer com o número certo, alimenta a barra de progresso, a sequência
   (streak) e o calendário da semana — tudo calculado automaticamente a
   partir das datas reais de publicação, sem nenhum campo extra para
   preencher.
4. (Opcional) Cole o link de um vídeo do YouTube no campo correspondente.
5. (Opcional) Preencha as 3 perguntas personalizadas do box "Como Fazer".
   Se deixar em branco, perguntas padrão genéricas aparecem no lugar.
6. Defina uma imagem destacada se tiver uma capa; sem imagem, o tema usa
   automaticamente um dos 6 gradientes da paleta da marca (sempre o mesmo
   gradiente para o mesmo post).
7. Publicar. Sem precisar montar layout nenhum — o template já está pronto.

Publicar um **Ensinamento** é igual, mas marque a categoria **Ensinamentos**
e escolha o **Papel** (Marido/Pai/Filho/Sacerdote) e, se quiser, a
subcategoria certa (ex: Marido → Fidelidade) na caixa de taxonomia "Papéis"
no editor.

## O que ficou de fora de propósito

- Só a tela **Marido** está com conteúdo de exemplo navegável — Pai, Filho e
  Sacerdote aparecem como cards na página de Ensinamentos (igual ao
  protótipo, sem link) mas já funcionam automaticamente assim que você
  marcar algum post com esses papéis, porque usam o mesmo template
  genérico (`taxonomy-papel.php`).
- O botão "QUERO FAZER PARTE" (Homens de Honra) e o card "Comece Aqui" não
  têm link, igual ao protótipo — o pedido era só ter o botão lá.
- Imagens de capa: o tema usa gradientes de marca como placeholder. Basta
  definir uma "Imagem destacada" em qualquer post para substituir pelo
  gradiente automaticamente.

## Personalização

Em **Aparência → Personalizar → Bíblia de Homem**: imagem de fundo do hero
da Home (opcional — sem imagem, usa um gradiente de marca) e os links de
LinkedIn / YouTube / Instagram do rodapé.
