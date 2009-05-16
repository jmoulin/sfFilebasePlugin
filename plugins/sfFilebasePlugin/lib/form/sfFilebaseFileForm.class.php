<?php
/**
 * This file is part of the sfFilebasePlugin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   de.optimusprime.sfFilebasePlugin
 * @author    Johannes Heinen <johannes.heinen@gmail.com>
 * @license   MIT license
 * @copyright 2007-2009 Johannes Heinen <johannes.heinen@gmail.com>
 */
class sfFilebaseFileForm extends BasesfFilebaseFileForm
{
  public function configure()
  {
    unset($this->widgetSchema['hash']);
    unset($this->validatorSchema['hash']);

    $this->widgetSchema['pathname']     = new sfWidgetFormInputFile();
    $this->validatorSchema['pathname']  = new sfFilebasePluginValidatorFile(array('allow_overwrite'=> true, 'required'=>true));
    $this->widgetSchema['tags'] = new sfWidgetFormInput();
    $this->validatorSchema['tags'] = new sfValidatorAnd(array(
      new sfValidatorString(),
      new sfValidatorRegex(array('pattern'=>'#^[^, ;]([^, ;]+[,; ] ?)*?[^, ;]+$#'))
    ), array('required'=>false));

    if( ! $this->isNew())
    {
      $tag_string = $this->getObject()->getTagsAsString();
      $this->widgetSchema['tags']->setDefault($tag_string);
      $this->validatorSchema['pathname']->setOption('required',false);
    }
  }

  /**
   * Betray him in a very nasty way ...
   * This is not a real column, but who cares...
   * 
   * @param array $values
   */
  public function updateTagsColumn($tags)
  {
    $this->getObject()->setTags(sfFilebaseTagPeer::splitTags($tags));
  }

  /**
   * Saves the current file for the field.
   *
   * @param  string          $field    The field name
   * @param  string          $filename The file name of the file to save
   * @param  sfValidatedFile $file     The validated file to save
   *
   * @return sfPluginValidatorUploadedFile The filename used to save the file
   */
  public function saveFile($field, $filename = null, sfValidatedFile $file = null)
  {
    $file = parent::saveFile($field, $filename, $file);
    //return $file;
    $this->getObject()->setHash($file->getHash());
    return $file->getPathname();

  }
}
