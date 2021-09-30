<?php

namespace App\YTB;

class YtbScrapper
{
    public static function getVideo($theme, $text)
    {
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
        return system('python3 /root/Searcher.py ' . "\"" . $theme . "\"" . "+" . "\"" . $m_c . "\"");
    }
}

