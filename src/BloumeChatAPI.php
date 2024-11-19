<?php

namespace BloumeChat;

class BloumeChatAPI
{
    private $base_url = 'https://bloumechat.com/api/v1/oauth2/resources';

    // Fonction pour récupérer les infos d'un utilisateur avec access_token
    public function getUserInfo($access_token, $app_secret)
    {
        // Créer l'URL avec le token
        $url = $this->base_url . '?access_tokens=' . $access_token . '&app_secret=' . $app_secret;

        // Initialiser cURL
        $ch = curl_init();

        // Configurer cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        // Exécuter la requête et stocker la réponse
        $response = curl_exec($ch);

        // Vérifier si une erreur cURL est survenue
        if (curl_errno($ch)) {
            echo 'Erreur cURL : ' . curl_error($ch);
            return null;
        }

        // Fermer cURL
        curl_close($ch);

        // Décoder la réponse JSON
        $decodedResponse = json_decode($response, true);

        // Retourner la réponse décodée
        return $decodedResponse;
    }
}
