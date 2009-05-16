<?php

class PluginSfFilebaseTagPeer extends BasesfFilebaseTagPeer
{
  /**
   * Splits a tag-string like
   * tag1, tag2 tag3; tag4 ... tag-n into
   * an array.
   *
   * @param string $tags
   * @return array $tags
   */
  public static function splitTags($tags)
  {
    return preg_split('#[,; ] ?#', $tags, null, PREG_SPLIT_NO_EMPTY);
  }
}
