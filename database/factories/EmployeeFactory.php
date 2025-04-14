<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            // Personal Information
            'nom' => $this->faker->lastName(),
            'prenoms' => $this->faker->firstName(),
            'date_naissance' => $this->faker->date('Y-m-d'), // Date of birth (adjust format)
            'sexe' => $this->faker->randomElement(['Masculin', 'Féminin', 'Autres']), // Gender
            'etat_civil' => $this->faker->randomElement(['Mr', 'Mme', 'Mlle']), // Marital status
            'adresse' => $this->faker->address(), // Full address
            'telephone' => $this->faker->phoneNumber(), // Phone number
            'email' => $this->faker->unique()->safeEmail(), // Email address
            'photo_identite' => $this->faker->imageUrl(400, 400, 'people'), // Random photo URL

            // Professional Information
            'employee_id' => $this->faker->unique()->numberBetween(100000, 999999), // Employee ID (updated)
            'poste' => $this->faker->jobTitle(), // Job position
            'departement' => $this->faker->word(), // Department
            'date_embauche' => $this->faker->date('Y-m-d'), // Hiring date (adjust format)
            'type_de_contrat' => $this->faker->randomElement(['CDI', 'CDD', 'Freelance']), // Contract type
            'duree_contrat' => $this->faker->numberBetween(12, 60), // Contract duration in months
            'lieu_affectation' => $this->faker->city(), // Place of assignment

            // Salary Information
            'salaire_base' => $this->faker->numberBetween(30000, 100000), // Gross salary
            'mode_paiement' => $this->faker->randomElement(['Virement bancaire', 'Chèque', 'Espèces']), // Payment mode
            'compte_bancaire' => $this->faker->iban(), // Bank account number (IBAN)
            'nom_banque' => $this->faker->company(), // Bank name
            'frequence_paiement' => $this->faker->randomElement(['Mensuel', 'Bimensuel']), // Payment frequency

            // Fiscal and Social Status
            'num_securite_sociale' => $this->faker->unique()->randomNumber(9), // Social security number
            'num_ifu' => $this->faker->unique()->randomNumber(9), // Tax identification number
            'retraite' => $this->faker->boolean(), // Retirement regime or allocation
            'taxe_appliquee' => $this->faker->numberBetween(3, 8), // Tax applied status

            // Document Uploads (placeholders) nombre_heure_sem_assignee
            'nombre_heure_sem_assignee' => $this->faker->numberBetween(40, 100), //
            'nombre_heure_assignee' => $this->faker->numberBetween(40, 100), //
            'contrat_signe' => $this->faker->imageUrl(400, 400, 'people'), // Signed contract (filename or placeholder)
            'carte_identite' => $this->faker->imageUrl(400, 400, 'people'), // Identity card (filename or placeholder)
            'certificats_diplomes' => $this->faker->imageUrl(400, 400, 'people'), // Certificates or diplomas (filename or placeholder)
            'rib' => $this->faker->imageUrl(400, 400, 'people'), // Bank identity statement (filename or placeholder)
        ];
    }
}
