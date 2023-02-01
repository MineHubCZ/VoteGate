# VoteGate

API webová mikroaplikace zprostředkující údaje o hlasování. Jednoduše, standardizovaně a na jednom místě.

V produkci na https://votegate.minehub.cz.

Tento repozitář je zrcadlený a nepřijímá pull requesty.

## Instalace

```sh
$ make
```

Následně je potřeba vyplnit soubor `.env` kde

| Klíč                  | Popis                           |
|-----------------------|---------------------------------|
| TOKEN                 | Api token pro autorizaci        |
| DEBUG_MODE            | Vypne/zapne debug mode          |
| BASE_URL              | URL, kde bude aplikace dostupná |
| CZECH_CRAFT_SLUG      | Slug pro CzechCraft             |
| CRAFTLIST_SLUG        | Slug pro CraftList              |
| CRAFTLIST_API_TOKEN   | Api token pro CraftList         |
| MINECRAFT_LIST_SLUG   | Slug pro Minecraft List         |
| MINECRAFTSERVERY_SLUG | Slug pro Minecraft Servery      |
| MINECRAFTSERVERY_ID   | Id pro Minecraft Servery        |
