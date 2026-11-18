import 'package:flutter/material.dart';

import 'inscription.dart';

class ConnexionPage extends StatefulWidget {
  const ConnexionPage({super.key});

  @override
  State<ConnexionPage> createState() => _ConnexionPageState();
}

class _ConnexionPageState extends State<ConnexionPage> {
  final _formKey = GlobalKey<FormState>();
  final _identifiantController = TextEditingController();
  final _motDePasseController = TextEditingController();
  bool _masquerMotDePasse = true;

  @override
  void dispose() {
    _identifiantController.dispose();
    _motDePasseController.dispose();
    super.dispose();
  }

  void _seConnecter() {
    if (!_formKey.currentState!.validate()) return;

    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text('Formulaire valide. La connexion reste à brancher.'),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    const vert = Color(0xFF31B879);

    return Scaffold(
      appBar: AppBar(title: const Text('Connexion')),
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
                      'Bon retour !',
                      textAlign: TextAlign.center,
                      style: Theme.of(context).textTheme.headlineSmall?.copyWith(
                            fontWeight: FontWeight.bold,
                          ),
                    ),
                    const SizedBox(height: 8),
                    Text(
                      'Connectez-vous à votre compte Sport Manager.',
                      textAlign: TextAlign.center,
                      style: TextStyle(color: Colors.grey.shade700),
                    ),
                    const SizedBox(height: 28),
                    TextFormField(
                      controller: _identifiantController,
                      textInputAction: TextInputAction.next,
                      decoration: const InputDecoration(
                        labelText: 'Identifiant',
                        prefixIcon: Icon(Icons.person_outline),
                        border: OutlineInputBorder(),
                      ),
                      validator: (value) => value == null || value.trim().isEmpty
                          ? 'Saisissez votre identifiant.'
                          : null,
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _motDePasseController,
                      obscureText: _masquerMotDePasse,
                      onFieldSubmitted: (_) => _seConnecter(),
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
                      validator: (value) => value == null || value.isEmpty
                          ? 'Saisissez votre mot de passe.'
                          : null,
                    ),
                    const SizedBox(height: 24),
                    FilledButton(
                      onPressed: _seConnecter,
                      style: FilledButton.styleFrom(
                        backgroundColor: vert,
                        padding: const EdgeInsets.symmetric(vertical: 15),
                      ),
                      child: const Text('Se connecter'),
                    ),
                    const SizedBox(height: 12),
                    TextButton(
                      onPressed: () => Navigator.push(
                        context,
                        MaterialPageRoute<void>(
                          builder: (_) => const InscriptionPage(),
                        ),
                      ),
                      child: const Text('Vous n’avez pas de compte ? Inscription'),
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
