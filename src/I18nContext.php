<?php
namespace Packaged\ContextI18n;

use Packaged\Context\Context;
use Packaged\I18n\Translators\Translator;

abstract class I18nContext extends Context
{
  const DEFAULT_LANGUAGE = 'en';
  protected $_language = self::DEFAULT_LANGUAGE;

  /**
   * Visitors preferred languages
   *
   * @return array
   */
  protected function _preferredLanguages(): array
  {
    return [$this->request()->getPreferredLanguage()];
  }

  /**
   * Languages supported by the visitor
   *
   * @return array
   */
  protected function _attemptLanguages()
  {
    return array_unique(
      array_merge($this->_preferredLanguages(), $this->request()->getLanguages(), [static::DEFAULT_LANGUAGE])
    );
  }

  protected function _setLanguage($language)
  {
    $this->_language = $language;
    return $this;
  }

  /**
   * Current displayed language (this is set AFTER prepare translator is called)
   *
   * @return string
   */
  public function currentLanguage()
  {
    return $this->_language;
  }

  abstract protected function _translator(): Translator;
}
