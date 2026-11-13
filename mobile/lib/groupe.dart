import 'package:flutter/material.dart';

const _navy = Color(0xFF142B45);
const _green = Color(0xFF31B879);

class GroupPage extends StatelessWidget {
  const GroupPage({super.key});

  static const _teams = [
    _Team('Les Aigles', '12 joueurs', 'Coach Martin', Color(0xFF31B879), '2019'),
    _Team('Étoile Sportive', '18 joueurs', 'Coach Dupont', Color(0xFF4776D0), '2021'),
    _Team('Olympique Club', '15 joueurs', 'Coach Bernard', Color(0xFFE69B35), '2020'),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F7FA),
      body: SafeArea(
        child: Column(children: [
          _PageHeader(title: 'Équipes', subtitle: 'Retrouvez vos équipes', icon: Icons.groups_rounded),
          Expanded(
            child: ListView(padding: const EdgeInsets.fromLTRB(20, 8, 20, 20), children: [
              Row(children: [
                const Expanded(child: Text('Mes équipes', style: TextStyle(fontSize: 20, fontWeight: FontWeight.w800, color: _navy))),
                _CountBadge(count: _teams.length),
              ]),
              const SizedBox(height: 14),
              ..._teams.map((team) => Padding(
                padding: const EdgeInsets.only(bottom: 12),
                child: _TeamCard(team: team, onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => _TeamDetailPage(team: team)))),
              )),
            ]),
          ),
        ]),
      ),
    );
  }
}

class _Team {
  const _Team(this.name, this.players, this.coach, this.color, this.year);
  final String name, players, coach, year;
  final Color color;
}

class _TeamCard extends StatelessWidget {
  const _TeamCard({required this.team, required this.onTap});
  final _Team team;
  final VoidCallback onTap;

  @override
  Widget build(BuildContext context) => Card(
    margin: EdgeInsets.zero,
    color: Colors.white,
    elevation: 0,
    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(18), side: const BorderSide(color: Color(0xFFE8EDF2))),
    child: InkWell(
      borderRadius: BorderRadius.circular(18),
      onTap: onTap,
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Row(children: [
          Container(width: 54, height: 54, decoration: BoxDecoration(color: team.color.withValues(alpha: .12), borderRadius: BorderRadius.circular(16)), child: Icon(Icons.shield_rounded, color: team.color, size: 30)),
          const SizedBox(width: 14),
          Expanded(child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [
            Text(team.name, style: const TextStyle(fontSize: 16, fontWeight: FontWeight.w700, color: _navy)),
            const SizedBox(height: 6),
            Text('${team.players}  ·  ${team.coach}', style: const TextStyle(fontSize: 12, color: Color(0xFF778497))),
          ])),
          const Icon(Icons.chevron_right_rounded, color: Color(0xFF9AA6B2)),
        ]),
      ),
    ),
  );
}

class _TeamDetailPage extends StatelessWidget {
  const _TeamDetailPage({required this.team});
  final _Team team;
  @override
  Widget build(BuildContext context) => Scaffold(
    backgroundColor: const Color(0xFFF5F7FA),
    appBar: AppBar(title: const Text('Détail de l’équipe'), backgroundColor: const Color(0xFFF5F7FA), foregroundColor: _navy),
    body: ListView(padding: const EdgeInsets.all(20), children: [
      Container(padding: const EdgeInsets.all(22), decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(20)), child: Column(children: [
        CircleAvatar(radius: 36, backgroundColor: team.color.withValues(alpha: .12), child: Icon(Icons.shield_rounded, color: team.color, size: 40)),
        const SizedBox(height: 12), Text(team.name, style: const TextStyle(fontSize: 22, fontWeight: FontWeight.w800, color: _navy)),
        const SizedBox(height: 16), _InfoRow(label: 'Coach', value: team.coach), _InfoRow(label: 'Créée en', value: team.year), _InfoRow(label: 'Effectif', value: team.players),
      ])),
      const SizedBox(height: 20), const Text('Joueurs de l’équipe', style: TextStyle(fontSize: 18, fontWeight: FontWeight.w800, color: _navy)),
      const SizedBox(height: 10),
      for (final name in ['Lucas Martin', 'Adam Bernard', 'Noah Petit']) ListTile(contentPadding: EdgeInsets.zero, leading: const CircleAvatar(backgroundColor: Color(0xFFE2F5EC), child: Icon(Icons.person, color: _green)), title: Text(name), subtitle: const Text('Milieu'), trailing: const Icon(Icons.chevron_right)),
    ]),
  );
}

class _PageHeader extends StatelessWidget {
  const _PageHeader({required this.title, required this.subtitle, required this.icon});
  final String title, subtitle;
  final IconData icon;
  @override
  Widget build(BuildContext context) => Padding(padding: const EdgeInsets.fromLTRB(20, 18, 20, 16), child: Row(children: [
    Container(width: 48, height: 48, decoration: BoxDecoration(color: const Color(0xFFE2F5EC), borderRadius: BorderRadius.circular(15)), child: Icon(icon, color: _green)),
    const SizedBox(width: 13), Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Text(title, style: const TextStyle(fontSize: 23, fontWeight: FontWeight.w800, color: _navy)), Text(subtitle, style: const TextStyle(fontSize: 13, color: Color(0xFF778497)))])
  ]));
}

class _CountBadge extends StatelessWidget {
  const _CountBadge({required this.count});
  final int count;
  @override
  Widget build(BuildContext context) => Container(padding: const EdgeInsets.symmetric(horizontal: 11, vertical: 6), decoration: BoxDecoration(color: const Color(0xFFE2F5EC), borderRadius: BorderRadius.circular(20)), child: Text('$count', style: const TextStyle(color: _green, fontWeight: FontWeight.w700)));
}

class _InfoRow extends StatelessWidget {
  const _InfoRow({required this.label, required this.value});
  final String label, value;
  @override
  Widget build(BuildContext context) => Padding(padding: const EdgeInsets.symmetric(vertical: 6), child: Row(children: [Expanded(child: Text(label, style: const TextStyle(color: Color(0xFF778497)))), Text(value, style: const TextStyle(color: _navy, fontWeight: FontWeight.w600))]));
}
