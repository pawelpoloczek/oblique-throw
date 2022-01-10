<?php
declare(strict_types=1);

namespace App\Traits;

use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

trait FormErrorsTrait
{
    public function getFormErrorMessages(
        FormInterface $form,
        TranslatorInterface $translator
    ): array {
        $errorMessages = [];
        foreach ($form->getErrors() as $key => $error) {
            $template = $error->getMessageTemplate();
            $parameters = $error->getMessageParameters();

            foreach ($parameters as $var => $value) {
                $template = str_replace($var, $value, $template);
            }

            $errorMessages[$key] = $translator->trans($template);
        }

        if ($form->count()) {
            foreach ($form as $child) {
                if (!$child->isValid()) {
                    $errorKey = $translator->trans($child->getName());
                    $errorMessages[$errorKey] = $this->getFormErrorMessages($child, $translator);
                }
            }
        }

        return $errorMessages;
    }
}
