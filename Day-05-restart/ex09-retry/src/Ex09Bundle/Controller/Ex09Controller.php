<?php

namespace App\Ex09Bundle\Controller;

use App\Entity\Address;
use App\Entity\BankAccount;
use App\Entity\Person;
use App\Form\AddressType;
use App\Form\BankAccountType;
use App\Form\PersonType;
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
        $persons = $em->getRepository(Person::class)->findAll();

        $person = new Person();
        $formPerson = $this->createForm(PersonType::class, $person);
        $formPerson->handleRequest($request);

        // Changement : gestion des messages via FlashBag (plus de query string)
        // On n'utilise plus $request->query->get('success')/$error

        // Gestion formulaire de création Person
        if ($formPerson->isSubmitted() && $formPerson->isValid()) {
            try {
                $em->persist($person);
                $em->flush();
                $this->addFlash('success', 'Personne ajoutée avec succès.');
                return $this->redirectToRoute('ex09_index');
            } catch (\Exception $e) {
                $this->addFlash('error', "Erreur lors de l'ajout de la personne : " . $e->getMessage());
            }
        }

        return $this->render('index.html.twig', [
            'persons' => $persons,
            'formPerson' => $formPerson->createView(),
            // Modif : plus besoin de passer success/error
        ]);
    }

    /**
     * @Route("/ex09/create_ba/{id}", name="ex09_create_ba")
     */
    public function createBankAccount(Request $request, EntityManagerInterface $em, $id): Response
    {
        $person = $em->getRepository(Person::class)->find($id);
        if (!$person) {
            $this->addFlash('error', "Personne non trouvée.");
            return $this->redirectToRoute('ex09_index');
        }

        $bankAccount = new BankAccount();
        $bankAccount->setPerson($person);

        $formBankAccount = $this->createForm(BankAccountType::class, $bankAccount);
        $formBankAccount->handleRequest($request);

        if ($formBankAccount->isSubmitted() && $formBankAccount->isValid()) {
            try {
                $em->persist($bankAccount);
                $em->flush();
                $this->addFlash('success', "Compte bancaire ajouté avec succès.");
                return $this->redirectToRoute('ex09_index');
            } catch (\Exception $e) {
                $this->addFlash('error', "Erreur lors de l'ajout du compte bancaire : " . $e->getMessage());
                return $this->redirectToRoute('ex09_index');
            }
        }

        $persons = $em->getRepository(Person::class)->findAll();

        return $this->render('index.html.twig', [
            'persons' => $persons,
            'formPerson' => $this->createForm(PersonType::class, new Person())->createView(),
            'formBankAccount' => $formBankAccount->createView(),
            'personToEdit' => $person,
        ]);
    }

    /**
     * @Route("/ex09/create_address/{id}", name="ex09_create_address")
     */
    public function createAddress(Request $request, EntityManagerInterface $em, $id): Response
    {
        $person = $em->getRepository(Person::class)->find($id);
        if (!$person) {
            $this->addFlash('error', "Personne non trouvée.");
            return $this->redirectToRoute('ex09_index');
        }

        $address = new Address();
        $address->setPerson($person);

        $formAddress = $this->createForm(AddressType::class, $address);
        $formAddress->handleRequest($request);

        if ($formAddress->isSubmitted() && $formAddress->isValid()) {
            try {
                $em->persist($address);
                $em->flush();
                $this->addFlash('success', "Adresse ajoutée avec succès.");
                return $this->redirectToRoute('ex09_index');
            } catch (\Exception $e) {
                $this->addFlash('error', "Erreur lors de l'ajout de l'adresse : " . $e->getMessage());
                return $this->redirectToRoute('ex09_index');
            }
        }

        $persons = $em->getRepository(Person::class)->findAll();

        return $this->render('index.html.twig', [
            'persons' => $persons,
            'formPerson' => $this->createForm(PersonType::class, new Person())->createView(),
            'formAddress' => $formAddress->createView(),
            'personToEdit' => $person,
        ]);
    }

    /**
     * @Route("/ex09/update/{id}", name="ex09_update")
     */
    public function updatePerson(Request $request, Person $person, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                $this->addFlash('success', "Personne modifiée avec succès.");
                return $this->redirectToRoute('ex09_index');
            } catch (\Exception $e) {
                $this->addFlash('error', "Erreur modification : " . $e->getMessage());
                return $this->redirectToRoute('ex09_index');
            }
        }

        return $this->render('update.html.twig', [
            'form' => $form->createView(),
            'person' => $person,
        ]);
    }

    /**
     * @Route("/ex09/delete/{id}", name="ex09_delete", methods={"POST"}) // Changement : on passe en POST pour plus de sécurité
     */
    public function deletePerson(Person $person, EntityManagerInterface $em): Response
    {
        try {
            $em->remove($person);
            $em->flush();
            $this->addFlash('success', "Personne supprimée.");
        } catch (\Exception $e) {
            $this->addFlash('error', "Erreur suppression : " . $e->getMessage());
        }
        return $this->redirectToRoute('ex09_index');
    }
}
