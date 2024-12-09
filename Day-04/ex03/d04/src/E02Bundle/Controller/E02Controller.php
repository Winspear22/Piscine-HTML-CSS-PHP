<?php

namespace App\E02Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;

class E02Controller extends AbstractController
{
    /**
    * @Route("/e02", name="e02_form")
    */
    public function form(Request $request): Response
    {
        // Créer le formulaire
        $form = $this->createFormBuilder([
            // Valeurs par défaut, au cas où
            'message' => '',
            'include_timestamp' => 'No',
        ])
            ->add('message', TextType::class, [
                'label' => 'Message',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le message ne peut pas être vide.',
                    ]),
                ],
            ])
            ->add('include_timestamp', ChoiceType::class, [
                'label' => 'Include timestamp',
                'choices' => [
                    'Yes' => 'Yes',
                    'No' => 'No',
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        $lastLine = null; // Pour afficher la dernière ligne ajoutée

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $logFile = $this->getParameter('app.log_file');

            // Vérifier l'existence du fichier, sinon le créer
            if (!file_exists($logFile)) {
                touch($logFile);
            }

            // Construire la ligne à ajouter
            $line = $data['message'];
            if ($data['include_timestamp'] === 'Yes') {
                $line .= ' | ' . (new \DateTime())->format('Y-m-d H:i:s');
            }

            // Ajouter la ligne au fichier
            file_put_contents($logFile, $line.PHP_EOL, FILE_APPEND);

            // Lire la dernière ligne du fichier pour l'afficher
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines && count($lines) > 0) {
                $lastLine = end($lines);
            }
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            // Le formulaire a été soumis mais n'est pas valide
            // Le champ 'message' est vide par exemple
            // On reste sur la même page, le form affichera l'erreur
        }

        // Afficher la page du formulaire avec la dernière ligne si existante
        return $this->render('form.html.twig', [
            'form' => $form->createView(),
            'last_line' => $lastLine,
        ]);
    }
}
?>