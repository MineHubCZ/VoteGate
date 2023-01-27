# VoteGate

API webová mikroaplikace zprostředkující údaje o hlasování. Jednoduše, standardizovaně a na jednom místě.

V produkci na https://votegate.minehub.cz.

Tento repozitář je zrcadlený a nepřijímá pull requesty.

## Instalace

```sh
$ make
```

Následně je potřeba vyplnit soubor `.env` kde

| Klíč                  | Popis                      |
|-----------------------|----------------------------|
| TOKEN                 | api token pro autorizaci   |
| DEBUG_MODE            | vypne/zapne debug mode     |
| BASE_URL              | url adresa webu            |
| CZECH_CRAFT_SLUG      | slug pro CzechCraft        |
| CRAFTLIST_SLUG        | slug pro CraftList         |
| CRAFTLIST_API_TOKEN   | api token pro CraftList    |
| MINECRAFT_LIST_SLUG   | slug pro Minecraft List    |
| MINECRAFTSERVERY_SLUG | slug pro Minecraft Servery |
| MINECRAFTSERVERY_ID   | id pro Minecraft Servery   |
