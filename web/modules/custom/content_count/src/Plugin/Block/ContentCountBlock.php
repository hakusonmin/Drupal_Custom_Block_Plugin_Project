<?php

namespace Drupal\content_count\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 * Provides a 'Content Count' Block.
 *
 * @Block(
 *   id = "content_count_block",
 *   admin_label = @Translation("Content Count Block"),
 * )
 */
class ContentCountBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // カウントするノードの数を取得
    $node_count = \Drupal::entityQuery('node')
      ->accessCheck(TRUE)
      ->condition('type', 'page')
      ->condition('status', TRUE) // 公開済みのノードのみをカウント
      ->count()
      ->execute();

    // ブロックのレンダー配列を返す
    return [
      '#markup' => $this->t('Total published content: @count', ['@count' => $node_count]),
    ];
  }

}
