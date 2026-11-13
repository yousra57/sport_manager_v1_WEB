import 'package:flutter/material.dart';
import 'models/sport.dart';
import 'services/api_service.dart';
import 'widgets/api_builder.dart';

const _navy = Color(0xFF142B45);
const _green = Color(0xFF31B879);

// La recherche filtre les joueurs récupérés par l'API.
class PlayerPage extends StatefulWidget {
  const PlayerPage({super.key});
  @override
  State<PlayerPage> createState() => _PlayerPageState();
}

class _PlayerPageState extends State<PlayerPage> {
  String _recherche = '';

  @override
  Widget build(BuildContext context) => Scaffold(
    appBar: AppBar(title: const Text('Joueurs')),
    body: Column(
      children: [
        Padding(
          padding: const EdgeInsets.all(20),
          child: TextField(
            onChanged: (texte) =>
                setState(() => _recherche = texte.toLowerCase()),
            decoration: InputDecoration(
              hintText: 'Rechercher un joueur...',
              prefixIcon: const Icon(Icons.search),
              filled: true,
              fillColor: Colors.white,
              border: OutlineInputBorder(
                borderRadius: BorderRadius.circular(15),
              ),
            ),
          ),
        ),
        Expanded(
          child: ApiBuilder<List<dynamic>>(
            charger: ApiService.getJoueurs,
            builder: (donnees) {
              final joueurs = donnees
                  .map(
                    (json) => Joueur.fromJson(Map<String, dynamic>.from(json)),
                  )
                  .toList();
              final visibles = joueurs
                  .where(
                    (j) => '${j.nomComplet} ${j.poste}'.toLowerCase().contains(
                      _recherche,
                    ),
                  )
                  .toList();
              if (visibles.isEmpty) {
                return Center(
                  child: Text(
                    joueurs.isEmpty
                        ? 'Aucun joueur pour le moment.'
                        : 'Aucun joueur trouvé.',
                  ),
                );
              }
              return ListView(
                padding: const EdgeInsets.fromLTRB(20, 0, 20, 20),
                children: [
                  Text(
                    'Tous les joueurs (${visibles.length})',
                    style: const TextStyle(
                      fontSize: 20,
                      fontWeight: FontWeight.w800,
                      color: _navy,
                    ),
                  ),
                  const SizedBox(height: 12),
                  for (final joueur in visibles)
                    Card(
                      color: Colors.white,
                      elevation: 0,
                      margin: const EdgeInsets.only(bottom: 10),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(17),
                      ),
                      child: ListTile(
                        leading: CircleAvatar(
                          backgroundColor: const Color(0xFFE2F5EC),
                          child: Text(
                            '${joueur.numero ?? '—'}',
                            style: const TextStyle(color: _green),
                          ),
                        ),
                        title: Text(joueur.nomComplet),
                        subtitle: Text('${joueur.poste} · ${joueur.equipe}'),
                        trailing: const Icon(Icons.chevron_right),
                        onTap: () => Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (_) => JoueurDetailPage(id: joueur.id),
                          ),
                        ),
                      ),
                    ),
                ],
              );
            },
          ),
        ),
      ],
    ),
  );
}

// Chaque ouverture demande GET /api/joueur/{id} avec l'identifiant réel.
class JoueurDetailPage extends StatelessWidget {
  const JoueurDetailPage({super.key, required this.id});
  final int id;

  @override
  Widget build(BuildContext context) => Scaffold(
    appBar: AppBar(title: const Text('Détail du joueur')),
    body: ApiBuilder<Map<String, dynamic>>(
      charger: () => ApiService.getJoueur(id),
      builder: (json) {
        final joueur = Joueur.fromJson(json);
        return ListView(
          padding: const EdgeInsets.all(20),
          children: [
            Card(
              color: Colors.white,
              child: Padding(
                padding: const EdgeInsets.all(22),
                child: Column(
                  children: [
                    CircleAvatar(
                      radius: 38,
                      backgroundColor: const Color(0xFFE2F5EC),
                      child: Text(
                        '${joueur.numero ?? '—'}',
                        style: const TextStyle(fontSize: 27, color: _green),
                      ),
                    ),
                    const SizedBox(height: 12),
                    Text(
                      joueur.nomComplet,
                      style: const TextStyle(
                        fontSize: 22,
                        fontWeight: FontWeight.w800,
                        color: _navy,
                      ),
                    ),
                    Text(
                      '${joueur.poste} · ${joueur.age == null ? 'Âge non renseigné' : '${joueur.age} ans'}',
                    ),
                    Text(joueur.blesse ? 'Blessé' : 'Apte'),
                    const SizedBox(height: 20),
                    _SkillBar(label: 'Vitesse', value: joueur.vitesse),
                    _SkillBar(label: 'Endurance', value: joueur.endurance),
                    _SkillBar(label: 'Technique', value: joueur.technique),
                    _SkillBar(label: 'Force physique', value: joueur.force),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 16),
            Card(
              child: ListTile(
                leading: const Icon(Icons.groups_rounded, color: _green),
                title: const Text('Équipe'),
                subtitle: Text(joueur.equipe),
              ),
            ),
          ],
        );
      },
    ),
  );
}

class _SkillBar extends StatelessWidget {
  const _SkillBar({required this.label, required this.value});
  final String label;
  final int value;

  @override
  Widget build(BuildContext context) => Padding(
    padding: const EdgeInsets.only(top: 13),
    child: Column(
      children: [
        Row(
          children: [
            Expanded(child: Text(label)),
            Text('$value', style: const TextStyle(fontWeight: FontWeight.w700)),
          ],
        ),
        const SizedBox(height: 7),
        ClipRRect(
          borderRadius: BorderRadius.circular(8),
          child: LinearProgressIndicator(
            value: (value / 100).clamp(0.0, 1.0),
            minHeight: 7,
            backgroundColor: const Color(0xFFEAF0F3),
            color: _green,
          ),
        ),
      ],
    ),
  );
}
