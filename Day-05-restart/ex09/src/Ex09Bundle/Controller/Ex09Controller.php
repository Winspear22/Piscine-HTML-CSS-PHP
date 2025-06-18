<?php

namespace App\Ex09Bundle\Controller;

use App\Entity\Address;
use App\Entity\BankAccount;
use App\Entity\Person;
use App\Form\AddressTypeForm;
use App\Form\BankAccountTypeForm;
use App\Form\PersonTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex09Controller extends AbstractController
{
    /**
     * @Route("/ex09", name="ex09_index")
     */
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        // Liste des personnes
        $persons = $em->getRepository(Person::class)->findAll();

        // Création Person
        $person = new Person();
        $formPerson = $this->createForm(PersonTypeForm::class, $person);
        $formPerson->handleRequest($request);

        $success = $request->query->get('success');
        $error = $request->query->get('error');

        // Traitement soumission formulaire Person
        if ($formPerson->isSubmitted() && $formPerson->isValid()) {
            try {
                $em->persist($person);
                $em->flush();
                return $this->redirectToRoute('ex09_index', ['success' => 'Personne ajoutée avec succès.']);
            } catch (\Exception $e) {
                $error = "Erreur lors de l'ajout de la personne : " . $e->getMessage();
            }
        }

        return $this->render('index.html.twig', [
            'persons' => $persons,
            'formPerson' => $formPerson->createView(),
            'success' => $success,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/ex09/create_ba/{id}", name="ex09_create_ba")
     */
    public function createBankAccount(Request $request, EntityManagerInterface $em, $id): Response
    {
        $person = $em->getRepository(Person::class)->find($id);
        if (!$person)
            return $this->redirectToRoute('ex09_index', ['error' => "Personne non trouvée."]);

        $bankAccount = new BankAccount();
        $bankAccount->setPerson($person);

        $formBankAccount = $this->createForm(BankAccountTypeForm::class, $bankAccount);
        $formBankAccount->handleRequest($request);

        if ($formBankAccount->isSubmitted() && $formBankAccount->isValid()) {
            try {
                $em->persist($bankAccount);
                $em->flush();
                return $this->redirectToRoute('ex09_index', ['success' => "Compte bancaire ajouté avec succès."]);
            } catch (\Exception $e) {
                return $this->redirectToRoute('ex09_index', ['error' => "Erreur lors de l'ajout du compte bancaire : " . $e->getMessage()]);
            }
        }

        // On renvoie la liste complète + le formulaire de bankAccount visible sur la même page
        $persons = $em->getRepository(Person::class)->findAll();

        return $this->render('index.html.twig', [
            'persons' => $persons,
            'formPerson' => $this->createForm(PersonTypeForm::class, new Person())->createView(),
            'formBankAccount' => $formBankAccount->createView(),
            'personToEdit' => $person,
            'success' => null,
            'error' => null,
        ]);
    }

    /**
     * @Route("/ex09/create_address/{id}", name="ex09_create_address")
     */
    public function createAddress(Request $request, EntityManagerInterface $em, $id): Response
    {
        $person = $em->getRepository(Person::class)->find($id);
        if (!$person)
            return $this->redirectToRoute('ex09_index', ['error' => "Personne non trouvée."]);

        $address = new Address();
        $address->setPerson($person);

        $formAddress = $this->createForm(AddressTypeForm::class, $address);
        $formAddress->handleRequest($request);

        if ($formAddress->isSubmitted() && $formAddress->isValid()) {
            try {
                $em->persist($address);
                $em->flush();
                return $this->redirectToRoute('ex09_index', ['success' => "Adresse ajoutée avec succès."]);
            } catch (\Exception $e) {
                return $this->redirectToRoute('ex09_index', ['error' => "Erreur lors de l'ajout de l'adresse : " . $e->getMessage()]);
            }
        }

        // On renvoie la liste complète + le formulaire de Address visible sur la même page
        $persons = $em->getRepository(Person::class)->findAll();

        return $this->render('index.html.twig', [
            'persons' => $persons,
            'formPerson' => $this->createForm(PersonTypeForm::class, new Person())->createView(),
            'formAddress' => $formAddress->createView(),
            'personToEdit' => $person,
            'success' => null,
            'error' => null,
        ]);
    }

    /**
     * @Route("/ex09/update/{id}", name="ex09_update")
     */
    public function updatePerson(Request $request, Person $person, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PersonTypeForm::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                return $this->redirectToRoute('ex09_index', ['success' => "Personne modifiée avec succès."]);
            } catch (\Exception $e) {
                return $this->redirectToRoute('ex09_index', ['error' => "Erreur modification : " . $e->getMessage()]);
            }
        }

        return $this->render('update.html.twig', [
            'form' => $form->createView(),
            'person' => $person,
        ]);
    }

    /**
     * @Route("/ex09/delete/{id}", name="ex09_delete")
     */
    public function deletePerson(Person $person, EntityManagerInterface $em): Response
    {
        try {
            $em->remove($person);
            $em->flush();
            return $this->redirectToRoute('ex09_index', ['success' => "Personne supprimée."]);
        } catch (\Exception $e) {
            return $this->redirectToRoute('ex09_index', ['error' => "Erreur suppression : " . $e->getMessage()]);
        }
    }
}
