import 'package:flutter/material.dart';
import 'joueur.dart';
import 'models/sport.dart';
import 'services/api_service.dart';
import 'widgets/api_builder.dart';

const _navy = Color(0xFF142B45);
const _green = Color(0xFF31B879);

Color _couleur(String hex) => Color(
  int.tryParse('FF${hex.replaceFirst('#', '')}', radix: 16) ?? 0xFF31B879,
);

// La liste vient maintenant de GET /api/equipes, et non d'une liste fictive.
class GroupPage extends StatelessWidget {
  const GroupPage({super.key});

  @override
  Widget build(BuildContext context) => Scaffold(
    appBar: AppBar(title: const Text('Équipes')),
    body: ApiBuilder<List<dynamic>>(
      charger: ApiService.getEquipes,
      builder: (donnees) {
        final equipes = donnees
            .map((json) => Equipe.fromJson(Map<String, dynamic>.from(json)))
            .toList();
        if (equipes.isEmpty) {
          return const Center(child: Text('Aucune équipe pour le moment.'));
        }
        return ListView(
          padding: const EdgeInsets.all(20),
          children: [
            Text(
              'Mes équipes (${equipes.length})',
              style: const TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.w800,
                color: _navy,
              ),
            ),
            const SizedBox(height: 14),
            for (final equipe in equipes)
              Card(
                color: Colors.white,
                elevation: 0,
                margin: const EdgeInsets.only(bottom: 12),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(18),
                ),
                child: ListTile(
                  contentPadding: const EdgeInsets.all(14),
                  leading: CircleAvatar(
                    backgroundColor: _couleur(
                      equipe.couleur,
                    ).withValues(alpha: .12),
                    child: Icon(
                      Icons.shield_rounded,
                      color: _couleur(equipe.couleur),
                    ),
                  ),
                  title: Text(
                    equipe.nom,
                    style: const TextStyle(
                      fontWeight: FontWeight.w700,
                      color: _navy,
                    ),
                  ),
                  subtitle: Text(
                    '${equipe.effectif} joueur(s) · ${equipe.coach}',
                  ),
                  trailing: const Icon(Icons.chevron_right),
                  // On transmet l'identifiant BDD pour demander le vrai détail.
                  onTap: () => Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (_) => EquipeDetailPage(id: equipe.id),
                    ),
                  ),
                ),
              ),
          ],
        );
      },
    ),
  );
}

class EquipeDetailPage extends StatelessWidget {
  const EquipeDetailPage({super.key, required this.id});
  final int id;

  @override
  Widget build(BuildContext context) => Scaffold(
    appBar: AppBar(title: const Text('Détail de l’équipe')),
    body: ApiBuilder<Map<String, dynamic>>(
      charger: () => ApiService.getEquipe(id),
      builder: (json) {
        // L'API place les joueurs à l'intérieur de data.joueurs.
        final equipe = Equipe.fromJson(json);
        final joueurs = (json['joueurs'] as List)
            .map((j) => Joueur.fromJson(Map<String, dynamic>.from(j)))
            .toList();
        return ListView(
          padding: const EdgeInsets.all(20),
          children: [
            Card(
              color: Colors.white,
              child: Padding(
                padding: const EdgeInsets.all(22),
                child: Column(
                  children: [
                    Icon(
                      Icons.shield_rounded,
                      size: 56,
                      color: _couleur(equipe.couleur),
                    ),
                    const SizedBox(height: 12),
                    Text(
                      equipe.nom,
                      style: const TextStyle(
                        fontSize: 22,
                        fontWeight: FontWeight.w800,
                        color: _navy,
                      ),
                    ),
                    const SizedBox(height: 16),
                    Text('Coach : ${equipe.coach}'),
                    Text('Créée le : ${equipe.dateCreation}'),
                    Text('Effectif : ${joueurs.length} joueur(s)'),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 20),
            const Text(
              'Joueurs de l’équipe',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.w800,
                color: _navy,
              ),
            ),
            if (joueurs.isEmpty)
              const Padding(
                padding: EdgeInsets.all(20),
                child: Text('Aucun joueur dans cette équipe.'),
              ),
            for (final joueur in joueurs)
              ListTile(
                leading: const CircleAvatar(
                  child: Icon(Icons.person, color: _green),
                ),
                title: Text(joueur.nomComplet),
                subtitle: Text(joueur.poste),
                trailing: const Icon(Icons.chevron_right),
                onTap: () => Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (_) => JoueurDetailPage(id: joueur.id),
                  ),
                ),
              ),
          ],
        );
      },
    ),
  );
}
