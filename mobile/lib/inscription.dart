import 'package:flutter/material.dart';

import 'connexion.dart';

class InscriptionPage extends StatefulWidget {
  const InscriptionPage({super.key});

  @override
  State<InscriptionPage> createState() => _InscriptionPageState();
}

class _InscriptionPageState extends State<InscriptionPage> {
  final _formKey = GlobalKey<FormState>();
  final _nomController = TextEditingController();
  final _identifiantController = TextEditingController();
  final _motDePasseController = TextEditingController();
  final _confirmationController = TextEditingController();
  bool _masquerMotDePasse = true;

  @override
  void dispose() {
    _nomController.dispose();
    _identifiantController.dispose();
    _motDePasseController.dispose();
    _confirmationController.dispose();
    super.dispose();
  }

  void _creerCompte() {
    if (!_formKey.currentState!.validate()) return;

    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text('Formulaire valide. La création du compte reste à brancher.'),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    const vert = Color(0xFF31B879);

    return Scaffold(
      appBar: AppBar(title: const Text('Inscription')),
      body: SafeArea(
        child: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(24),
            child: ConstrainedBox(
              constraints: const BoxConstraints(maxWidth: 420),
              child: Form(
                key: _formKey,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    const Icon(Icons.sports_soccer_rounded, size: 64, color: vert),
                    const SizedBox(height: 16),
                    Text(
                      'Créer un compte',
                      textAlign: TextAlign.center,
                      style: Theme.of(context).textTheme.headlineSmall?.copyWith(
                            fontWeight: FontWeight.bold,
                          ),
                    ),
                    const SizedBox(height: 8),
                    Text(
                      'Rejoignez Sport Manager pour gérer votre équipe.',
                      textAlign: TextAlign.center,
                      style: TextStyle(color: Colors.grey.shade700),
                    ),
                    const SizedBox(height: 28),
                    TextFormField(
                      controller: _nomController,
                      textCapitalization: TextCapitalization.words,
                      textInputAction: TextInputAction.next,
                      decoration: const InputDecoration(
                        labelText: 'Nom complet',
                        prefixIcon: Icon(Icons.badge_outlined),
                        border: OutlineInputBorder(),
                      ),
                      validator: (value) => value == null || value.trim().isEmpty
                          ? 'Saisissez votre nom.'
                          : null,
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _identifiantController,
                      textInputAction: TextInputAction.next,
                      decoration: const InputDecoration(
                        labelText: 'Identifiant',
                        prefixIcon: Icon(Icons.person_outline),
                        border: OutlineInputBorder(),
                      ),
                      validator: (value) => value == null || value.trim().isEmpty
                          ? 'Choisissez un identifiant.'
                          : null,
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _motDePasseController,
                      obscureText: _masquerMotDePasse,
                      textInputAction: TextInputAction.next,
                      decoration: InputDecoration(
                        labelText: 'Mot de passe',
                        prefixIcon: const Icon(Icons.lock_outline),
                        border: const OutlineInputBorder(),
                        suffixIcon: IconButton(
                          tooltip: _masquerMotDePasse
                              ? 'Afficher le mot de passe'
                              : 'Masquer le mot de passe',
                          onPressed: () => setState(
                            () => _masquerMotDePasse = !_masquerMotDePasse,
                          ),
                          icon: Icon(
                            _masquerMotDePasse
                                ? Icons.visibility_outlined
                                : Icons.visibility_off_outlined,
                          ),
                        ),
                      ),
                      validator: (value) => value == null || value.length < 8
                          ? 'Le mot de passe doit contenir au moins 8 caractères.'
                          : null,
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _confirmationController,
                      obscureText: _masquerMotDePasse,
                      onFieldSubmitted: (_) => _creerCompte(),
                      decoration: const InputDecoration(
                        labelText: 'Confirmer le mot de passe',
                        prefixIcon: Icon(Icons.lock_outline),
                        border: OutlineInputBorder(),
                      ),
                      validator: (value) => value != _motDePasseController.text
                          ? 'Les mots de passe ne correspondent pas.'
                          : null,
                    ),
                    const SizedBox(height: 24),
                    FilledButton(
                      onPressed: _creerCompte,
                      style: FilledButton.styleFrom(
                        backgroundColor: vert,
                        padding: const EdgeInsets.symmetric(vertical: 15),
                      ),
                      child: const Text('Créer mon compte'),
                    ),
                    const SizedBox(height: 12),
                    TextButton(
                      onPressed: () => Navigator.pushReplacement(
                        context,
                        MaterialPageRoute<void>(
                          builder: (_) => const ConnexionPage(),
                        ),
                      ),
                      child: const Text('Vous avez déjà un compte ? Connexion'),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
