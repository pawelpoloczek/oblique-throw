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
            $errorMessages[$key] = $translator->trans($error->getMessage());
        }

        if ($form->count()) {
            foreach ($form as $child) {
                if (!$child->isValid()) {
                    $errorKey = $translator->trans($child->getName());
                    $errors = $this->getFormErrorMessages($child, $translator);
                    $errorMessages[$errorKey] = reset($errors);
                }
            }
        }

        return $errorMessages;
    }
}
