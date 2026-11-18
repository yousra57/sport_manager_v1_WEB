import 'package:flutter/material.dart';

import 'connexion.dart';

class ProfilPage extends StatelessWidget {
  const ProfilPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Profil')),
      body: Center(
        child: FilledButton.icon(
          onPressed: () => Navigator.pushAndRemoveUntil(
            context,
            MaterialPageRoute<void>(
              builder: (_) => const ConnexionPage(),
            ),
            (route) => false,
          ),
          icon: const Icon(Icons.logout),
          label: const Text('Déconnexion'),
        ),
      ),
    );
  }
}
