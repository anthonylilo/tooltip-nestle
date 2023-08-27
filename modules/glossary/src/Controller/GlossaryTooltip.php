<?php
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
