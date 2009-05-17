<?php

/**
 * sfAbstractFile form base class.
 *
 * @package    form
 * @subpackage sf_abstract_file
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasesfAbstractFileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'pathname'                   => new sfWidgetFormInput(),
      'hash'                       => new sfWidgetFormInput(),
      'comment'                    => new sfWidgetFormTextarea(),
      'sf_filebase_directories_id' => new sfWidgetFormDoctrineChoice(array('model' => 'sfFilebaseDirectory', 'add_empty' => true)),
      'type'                       => new sfWidgetFormInput(),
      'level'                      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorDoctrineChoice(array('model' => 'sfAbstractFile', 'column' => 'id', 'required' => false)),
      'pathname'                   => new sfValidatorString(array('max_length' => 255)),
      'hash'                       => new sfValidatorString(array('max_length' => 255)),
      'comment'                    => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'sf_filebase_directories_id' => new sfValidatorDoctrineChoice(array('model' => 'sfFilebaseDirectory', 'required' => false)),
      'type'                       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'level'                      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'sfAbstractFile', 'column' => array('pathname'))),
        new sfValidatorDoctrineUnique(array('model' => 'sfAbstractFile', 'column' => array('hash'))),
      ))
    );

    $this->widgetSchema->setNameFormat('sf_abstract_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfAbstractFile';
  }

}
