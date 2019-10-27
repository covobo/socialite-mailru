<?php

namespace Covobo\SocialiteProviders\MailRu;

use SocialiteProviders\Manager\SocialiteWasCalled;

class MailRuExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'mailru', MailRuProvider::class
        );
    }
}
