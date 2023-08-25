<?php
/*
Use case Drupal 8/9

Short Description: The words correspondent / identical to the items included in the glossary vocabulary are highlighted

Behaviour: Create a functionality that will allow admin to add words in the glossary with the description. After the term is added and published, the content of the page will be checked and if the word exists in the page it will add description to it. You can check behaviour on the designs.

Sub Tasks:
  1.	Create vocabulary for glossary terms.
  2.	Terms must have Title and Description (textfield, long)
  3.	Create functionality to scan the text inside the content type.
  4.	Create functionality to add description when the title word of the term exists in the page content.

Optional:
  1.	Create install function that will create the vocabulary on module install
  2.	 Limit the description on the page up to 100 chars, if the description is longer add “Read more” button that will lead user to the term page itself.
*/

namespace Drupal\glossary_tooltip\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class GlossaryTooltip extends ControllerBase
{
  public function view()
  {
    $query = \Drupal::database();
    $results = $query->select('glossary_tooltip', 'g')
      ->fields('g', ['id', 'title', 'description'])
      ->execute()->fetchAll(\PDO::FETCH_OBJ);

    $contentResult = [];

    if (!empty($results)) {
      foreach ($results as $result) {
        $content = [
          'id' => $result->id,
          'title' => $result->title,
          'description' => $result->description
        ];

        $contentResult[] = [
          '#theme' => 'glossary-listing',
          '#content' => $content,
        ];
      }
    }
    return $contentResult;
  }

  public function getDataUrl()
  {
    $query = \Drupal::database();
    $results = $query->select('glossary_tooltip', 'g')
      ->fields('g', ['id', 'title', 'description'])
      ->execute()->fetchAll(\PDO::FETCH_OBJ);

    $content = [];

    if (!empty($results)) {
      foreach ($results as $result) {
        $content[] = [
          'id' => $result->id,
          'title' => $result->title,
          'description' => $result->description
        ];
      }
    }
    return new JsonResponse($content);
  }

  public function getById($id)
  {
    if (!empty(trim($id))) {
      $query = \Drupal::database();
      $results = $query->select('glossary_tooltip', 'g')
        ->fields('g', ['id', 'title', 'description'])
        ->condition('id', $id)
        ->execute()->fetchAll(\PDO::FETCH_OBJ);

      $contentResult = [];

      if (!empty($results)) {
        foreach ($results as $result) {
          $content = [
            'id' => $result->id,
            'title' => $result->title,
            'description' => $result->description
          ];

          $contentResult[] = [
            '#theme' => 'glossary-listing',
            '#content' => $content,
          ];
        }
      }
      return $contentResult;
    }
  }
}
