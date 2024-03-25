<?php

namespace App\E02Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TotoController extends AbstractController
{

    /**
    * @Route("/submit-form", name="submit_form")
    */
    public function submitForm(Request $request): Response
    {
        // Récupérer les données soumises
        $message = $request->request->get('message');
        $includeTimestamp = $request->request->get('timestamp') === 'yes';

        // Valider les données (par exemple, vérifier que le message n'est pas vide)
        if (empty($message)) {
            // Gérer l'erreur, par exemple en réaffichant le formulaire avec un message d'erreur
        }

        // Traiter les données
        $content = $message;
        if ($includeTimestamp) {
            $content .= ' - ' . date('Y-m-d H:i:s');
        }

        // Écrire dans le fichier
        $filePath = $this->getParameter('message_file_path'); // Assurez-vous que ce paramètre est bien défini
        file_put_contents($filePath, $content . PHP_EOL, FILE_APPEND);

        // Rediriger vers une autre page ou afficher un message de succès
        return $this->redirectToRoute('form_page'); // Assurez-vous que la route 'form_page' existe
    }

	/**
    * @Route("/e02", name="form_page")
    */
    public function showForm(Request $request)
	{
		$form = $this->createFormBuilder()
			->add('message', TextType::class)
			->add('include_timestamp', ChoiceType::class, [
				'choices' => [
					'Yes' => 'yes',
					'No' => 'no',
				],
			])
			->add('send', SubmitType::class)
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			// Gérez la soumission ici
		}

		return $this->render('E02Bundle/main.html.twig', [
			'form' => $form->createView(),
		]);
	}

}