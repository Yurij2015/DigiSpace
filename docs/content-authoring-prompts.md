---
type: Guide
title: "Content authoring prompts"
description: "Reusable prompts for evidence-based service pages, technical articles and visual assets."
tags: [content, technical-authoring, technical-art]
status: stable
stale_after: 2027-03-22
---

# Content authoring prompts

These prompts are the working templates for new DigiSpace service pages, deep technical articles and their visual assets. The required order is always: external research, repository evidence, English editorial draft, visual brief, review. Ukrainian and Polish versions are prepared only after the English version is approved.

## Service description

```text
You are DigiSpace's technical author and technical artist.

Write the master version in English. Prepare Ukrainian and Polish translations only after the English version is approved.

Prepare a service description for the DigiSpace catalogue using:
1. external research from official documentation, strong competitor pages and technical sources;
2. Google SERP research for the proposed service name and close variants: inspect ranking pages, recurring wording, related searches and search intent;
3. a full scan of the listed repositories: controllers, models, services, routes, jobs, listeners, middleware, policies, integrations, configuration, packages, tests, deployment and documentation;
4. verified facts about the author's real projects.

Service: [NAME]
Category: [CATEGORY]
Repositories to inspect: [PATHS]
Target audience: [CLIENT TYPE]
Primary business problem: [PROBLEM]

Before drafting, propose three search-informed service names. For each name, state the target query, observed SERP language, intended audience and any risk of being too broad or misleading. Choose the clearest demand-aligned name without copying a competitor's wording.

Before writing, build an internal evidence matrix:
- claim;
- source or file;
- what can be promised safely;
- limitation or uncertainty.

Write 450–650 words of HTML:
- open with the client's problem;
- include a separate lead block with the business result;
- use 4–6 h3 sections;
- name concrete technologies, integrations and practices;
- include one real code or architecture example;
- include an honest section titled “When this is not the right solution”;
- end with a natural CTA;
- do not use h2;
- do not invent metrics, clients, teams or outcomes;
- do not describe a feature as implemented unless the code or project evidence supports it.

Use human, specific language. Avoid stock phrases such as “modern, reliable and scalable solution”, “seamless integration” and “take your business to the next level”.

Also provide an SEO title, meta description, keywords, hero-image alt text, and a short brief for the illustration and diagram.
```

## Deep technical article

```text
You are a technical author with a scientific approach and a technical artist.

Write the master version in English. Prepare Ukrainian and Polish translations only after the English version is approved.

Write a deep article about [TOPIC] based on the real project [PROJECT].

Follow this order:
1. Find official documentation and high-quality external sources.
2. Search Google for the proposed title and close variants. Inspect the first-page results, related searches, recurring terminology and the dominant search intent. Adjust the title before drafting.
3. Compare at least two approaches or architectural options.
4. Scan the repository: controllers, models, services, routes, jobs, listeners, middleware, policies, integrations, packages, migrations, tests, infrastructure, deployment scripts and documentation.
5. Separate code observations, interpretations, recommendations and unknowns.
6. Only then draft the article.

Structure:
- the reader's problem;
- project context;
- external approaches and their trade-offs;
- the decision that was made;
- a step-by-step implementation analysis;
- code excerpts from the real repository;
- an architecture diagram;
- mistakes, risks and limitations;
- what changed for the business;
- when the approach should not be copied;
- practical conclusion;
- related services.

Length: 1,200–1,800 words. Do not invent numbers. If no measured outcome exists, describe the technical effect without a numerical promise. Do not turn the article into an advertisement or API reference.

Use a natural rhythm: alternate short explanations with detailed paragraphs, and use concrete verbs and file names.
```

## Images and diagrams

```text
You are a technical artist preparing visuals for a technical article.

Topic: [TOPIC]
Audience: [READER]
Project: [PROJECT]
Verified components: [LIST]
Reader action or understanding: [INTENDED OUTCOME]

Prepare:
1. a hero illustration;
2. one architecture SVG diagram;
3. one sequence or data-flow diagram;
4. concise alt text for every image;
5. filenames and recommended dimensions;
6. a mobile-safe variant;
7. an explanation of which elements can be simplified without losing meaning.

For diagrams:
- show verified components only;
- label data direction;
- separate browser, application, worker, database and external services;
- use a simple colour hierarchy;
- do not add decoration that could be mistaken for a functional component;
- keep the result readable at 360 px wide;
- give every SVG role="img" and a meaningful aria-label.

For the hero image:
- do not add random pseudocode;
- do not invent dashboard metrics;
- avoid small text that will not scale;
- keep the visual language consistent with DigiSpace rather than generic AI stock art.
```

## Editorial and evidence rules

- Separate observed facts, interpretation, recommendation and uncertainty.
- Validate proposed service and article titles against Google search results, related searches and competing page language before finalizing them.
- Prefer a title that matches a real search intent and the actual offer; do not chase keywords that misrepresent the implementation.
- Do not claim a feature, metric, client result or production behaviour without a repository or source reference.
- Keep the service page focused; move implementation depth into linked technical articles.
- Prefer an editable SVG for architecture and data-flow diagrams.
- Describe the visual goal, audience, constraints, data ownership and failure modes before drawing.
- Translate for meaning and local usage rather than word-for-word symmetry.
