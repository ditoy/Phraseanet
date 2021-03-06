<?php

namespace Alchemy\Tests\Phrasea\Form\Login;

use Alchemy\Phrasea\Form\Login\PhraseaRecoverPasswordForm;;
use Alchemy\Tests\Phrasea\Form\FormTestCase;

/**
 * @group functional
 * @group legacy
 */
class PhraseaRecoverPasswordFormTest extends FormTestCase
{
    protected function getForm()
    {
        return new PhraseaRecoverPasswordForm(self::$DI['app']['repo.tokens']);
    }
}
