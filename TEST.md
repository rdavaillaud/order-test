
Dans ce test, il a fallu partir complètement de 0.
J'ai pris le parti de le faire en clean arch pour l'exercice. Il aurait pu être fait plus simplement en mode purement Symfony, mais c'était moins amusant.

Dans un premier temps, j'ai commencé à tout créer, l'ensemble des repositories en écriture pour pouvoir remplir une base de données mémoire. Mais je me suis vite rendu compte qu'au final je n'en avais pas besoin.
J'ai repris ma copie, et généré uniquement la partie "lecture", puisque c'est ce qui est nécessaire ici.
D'abord orienté autour de l'entité Order, j'ai vite explosé les diverses méthodes de calcul de la TVA et des promotions dans des services annexes.

Dans un second temps je me suis attaqué à la partie frontend, en installant twig entre autre. Je n'ai pas cherché la complexité et j'ai utilisé Bootstrap via Webpack Encore pour faire la page présentant la commande.
Au niveau de la structure, sans contrainte particulière, j'ai utilisé une simple table et un design très simple.
Je n'ai pas poussé le design très loin, je n'ai, par exemple, pas ajouté les fonctionnalités telles que le retour aux pages précédentes, l'ajout/suppression de quantité de produit, etc..

Au niveau des tests, j'ai testé un use case sur le calcul des différentes valeurs que l'on afficherait, également des tests de fonctionnement sur les règles de coût de transport et de TVA, ainsi que le calcul des promotions.

Répertoire Domain presque vide?  
====

En effet, le domain est presque vide, mais c'est essentiellement parce que nous sommes en présence de code "lecture", qui se trouve dans la couche "Application" pour être accessible depuis la couche "Infrastructure" 

Evolutions
===

Si l'on veut faire évoluer les promotions, il suffit d'extraire le mécanisme telle la TVA ou les frais de port, et de passer l'objet Order et éventuellement d'autres paramètres à une fonction de calcul. Augmenter le niveau d'abstraction permettrait d'autres évolutions.  
Au niveau du front, évidemment, utiliser les style guides et des composants d'un design system serait plus optimal.

Questions
=====

Le fonctionnement des Promotions est compliqué pour moi. J'ai cru comprendre d'après Legifrance qu'elle est considérée Hors-taxe. Mais le calcul de la TVA doit il est fait sur la promotion? Si oui, à quel taux puisqu'il y en a des différents selon les produits.
