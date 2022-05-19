<?php
define("URL", str_replace("index.php", "", (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]));
try {

    require "controller/LivreController.php";
    $controller = new LivreController;

    if (empty($_GET['page'])) {
        require "view/accueilView.php";
    } else {
        $url = explode("/", filter_var($_GET["page"]), FILTER_SANITIZE_URL);
        switch ($url[0]) {
            case "accueil":
                require "view/accueilView.php";
                break;

            case "livres":
                if (count($url)  === 1) {
                    $controller->afficherLivres();
                    break;
                } else {
                    switch ($url[1]) {
                        case "lire":
                            // TODO : il faut que je lui donne l'ID du livre choisi
                            $controller->afficherLivre($url[2]);
                            break;
                        case "ajouter":
                            echo "Page ajouter";
                            break;
                        case "modifier":
                            echo "Page modifier";
                            break;
                        case "supprimer":
                            echo "Page supprimer";
                            break;
                        default:
                            throw new Exception("Aucune sous page trouvée");
                    }
                    break;
                }
            default:
                throw new Exception("Aucune page principale trouvée");
        }
    }
} catch (Exception $e) {
    echo "Erreur:" . $e->getMessage();
}
