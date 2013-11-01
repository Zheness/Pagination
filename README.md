# PHP Pagination

** English version in few days**

## À quoi ça sert ?

*Pagination*, permet simplement, comme son nom l'indique, de créer une **pagination**, en utilisant le **Bootstrap** twitter.

## Comment l'utiliser

L'utilisation est très simple :

    /*
     * Prenons comme exemple une gestion d'articles. J'ai en base 200 articles, et je souhaite en afficher 20 par pages.
     */
    // Vous appelez la classe
    include = 'pagination.class.php';
    
    // Vous l'instanciez
    $Pagination = new Pagination();
    
    // Vous configurez les options
    $Pagination->setNbMaxElements(200); // Nombre d'articles total
    $Pagination->setNbElementsInPage(20); // Nombre d'articles affichés par page
    $Pagination->setCurrentPage($_GET["page"]); // La page actuelle
    $Pagination->setInnerLinks(2); // Le nombre de liens à afficher autour de la page courante

    // Une fois les options configurées, on peut générer l'HTML
    $htmlPagination = $Pagination->renderBootstrapPagination();
    
    // Il ne vous reste plus qu'à faire un echo de $htmlPagination
    
    /*
     * Je n'ai pas mis (par rapidité) de variables pour les articles totaux, articles à afficher, etc. À vous de les rajouter.
     * Même chose pour $_GET["page"] à vous d'échapper les variables reçues !
     */

Après la génération, voici ce que l'on obtient :

    1 ... 3 4 5 6 7 ... 10

Où 5 est la page courante. Le tout stylisé avec Bootstrap.

### Les options

Vous pouvez configurer :

* Le nombre d'éléments total
* Le nombre d'éléments à afficher
* La page actuelle
* Le nombre de liens entourant la page actuelle
* Le lien de destination (**ne pas oublier** d'intégrer `{i}` qui correspond au numéro de page)
* La chaîne de caractère séparant les liens

## Pourquoi avec fait Pagination ?

Tout simplement car je n'aime pas vraiment les paginations *simples* avec deux boutons "précédent/suivant", où alors les numéros de pages qui se suivent.<br />
D'une part parce que si on à 200 pages, la pagination aura 200 liens.<br />
Ou alors on aura que X liens affichés à la suite et il faut arriver à la fin de la pagination pour voir la dernière page.

J'ai donc eu envie de coder une fonction capable d'afficher la première et la dernière page, puis j'ai poussé la fonction pour afficher X liens autour de ma page actuelle.

## Il y aura-t-il des fonctionnalités à venir ?

OUI ! Je prévois quelques options supplémentaires. Je suis en train de réféléchir à comment les implémenter. De plus, c'est mon premier code que je publie.

J'ai donc choisi github pour partager mes créations, avoir des avis et des aides de la communauté !

Je prévois également de faire mes codes en anglais pour toucher un maximum de monde. Il y aura une doc en Français, car je m'exprime mieux dans ma langue natale ;)