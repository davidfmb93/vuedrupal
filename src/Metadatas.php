<?php

namespace Drupal\vuedrupal;


class Metadatas {


    public function facebook($url, $type, $title, $description, $image) {

        return array (
            0 => 
            array (
              0 => array (
                '#tag' => 'meta',
                '#attributes' =>  array (
                  'property' => 'og:url',
                  'content' => $url,
                ),
              ),
              1 => 'og:url',
            ),
            1 => 
            array (
              0 => array (
                '#tag' => 'meta',
                '#attributes' =>  array (
                  'property' => 'og:type',
                  'content' => $type,
                ),
              ),
              1 => 'og:type',
            ),
            2 => 
            array (
              0 => array (
                '#tag' => 'meta',
                '#attributes' =>  array (
                  'property' => 'og:title',
                  'content' => $title,
                ),
              ),
              1 => 'og:title',
            ),
            3 => 
            array (
              0 => array (
                '#tag' => 'meta',
                '#attributes' =>  array (
                  'property' => 'og:description',
                  'content' => $description,
                ),
              ),
              1 => 'og:description',
            ),
            4 => 
            array (
              0 => array (
                '#tag' => 'meta',
                '#attributes' =>  array (
                  'property' => 'og:image',
                  'content' => $image,
                ),
              ),
              1 => 'og:image',
            ),
        );
    }

}