<?php
    $text = "De nombreux services vous attribuent un mot de passe « par défaut » : lors de votre inscription à un service en ligne ou lors de la création de votre espace client, la plupart des sites vous envoient un mail afin de vous transmettre un mot de passe, composé de manière aléatoire par un « générateur de mot de passe ».

Les mots de passe communiqués par e-mail présentent un risque de piratage accru, l’e-mail étant susceptible d’être intercepté par un pirate, qui aurait alors immédiatement accès à votre compte.

Pour mieux vous protéger, connectez-vous au compte concerné en utilisant le mot de passe fourni par défaut et modifiez-le dès votre première connexion par un autre que vous aurez composé vous-même.

Lorsque cela est possible, activez la double authentification. Cette option permet de contrôler votre identité par 2 moyens différents avant d’autoriser l’accès à votre compte : en tant qu’utilisateur, vous devez non seulement connaître votre mot de passe, mais également être capable de taper un code à usage unique, le plus souvent transmis par SMS. Ainsi, même en cas de piratage de votre mot de passe, l’accès à vos données demeurera impossible.

Certains logiciels utilisés par les pirates sont capables de tester toutes les combinaisons de caractères possibles. Ces tentatives de piratage sont nommées « attaques par force brute ».

Ainsi, plus le nombre de caractères du mot de passe est élevé, plus il faudra de temps à un tel programme pour découvrir la bonne combinaison. Pour cette même raison, vous devrez, pour créer un mot de passe performant :

combiner lettres minuscules et majuscules avec des chiffres et des caractères spéciaux.

choisissez toujours un mot de passe dont le nombre de caractères est supérieur ou égal à 8.";

    $theme = "mot de passe";

    // On divise le texte en mot
    $words = mb_split( ' +', $text );
    
    // On garde seulement les mots à + de 3 cara
    foreach ($words as $key=>$item){
        if(strlen($item) < 3){
            unset($words[$key]);
        }
    }
	
	$file = file("stop_words_french.txt");
	// Parcourt du tableau des mots du texte pour voir si ce sont des mots d'arret, si oui : supression
	foreach ($words as $key => $value){	
		foreach($file as $line) {
			$line = trim($line);
			if($line == $value) {
				unset($words[$key]);
			}
		}
	}	
    
    // Calculer de l'occurence des mots
    $uniqueWordCounts = array_count_values ( $words );
    
    // On classe par taille décroissante les mots les plus répandus
    arsort($uniqueWordCounts);
    $uniqueWord = array_flip($uniqueWordCounts); 
    $mots_cles = array_slice($uniqueWord, 0, 4);
    $m_c = implode(" ", $mots_cles);
    system('sh kill.sh');    
    system('python3 /root/Searcher.py ' . "\"" . $theme . "\"" . "+" . "\"" . $m_c . "\"");
?>
