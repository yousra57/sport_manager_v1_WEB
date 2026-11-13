import 'package:flutter/material.dart';


// liste et détail des équipes

const _navy = Color(0xFF142B45);
const _green = Color(0xFF31B879);

class PlayerPage extends StatefulWidget {
  const PlayerPage({super.key});

  @override
  State<PlayerPage> createState() => _PlayerPageState();
}

class _PlayerPageState extends State<PlayerPage> {
  final _search = TextEditingController();
  String _query = '';

  static const _players = [
    _Player('Lucas', 'Martin', 10, 'Attaquant', 22, 91, 84, 88, 79),
    _Player('Adam', 'Bernard', 8, 'Milieu', 20, 78, 90, 86, 75),
    _Player('Noah', 'Petit', 1, 'Gardien', 24, 72, 82, 68, 90),
    _Player('Hugo', 'Robert', 4, 'Défenseur', 21, 75, 80, 73, 92),
    _Player('Enzo', 'Richard', 7, 'Ailier', 19, 94, 77, 85, 70),
  ];

  @override
  void dispose() {
    _search.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final visible = _players.where((p) => '${p.firstName} ${p.lastName} ${p.position}'.toLowerCase().contains(_query.toLowerCase())).toList();
    return Scaffold(
      backgroundColor: const Color(0xFFF5F7FA),
      body: SafeArea(child: Column(children: [
        Padding(padding: const EdgeInsets.fromLTRB(20, 18, 20, 16), child: Row(children: [
          Container(width: 48, height: 48, decoration: BoxDecoration(color: const Color(0xFFE2F5EC), borderRadius: BorderRadius.circular(15)), child: const Icon(Icons.person_rounded, color: _green)),
          const SizedBox(width: 13), 
          const Column(
            crossAxisAlignment: CrossAxisAlignment.start, 
            children: [
              Text(
                'Joueurs', 
                style: TextStyle(fontSize: 23, fontWeight: FontWeight.w800, color: _navy)), 
                Text('L’effectif de votre club', style: TextStyle(fontSize: 13, color: Color(0xFF778497)))]),
        ])),
        Padding(padding: const EdgeInsets.fromLTRB(20, 0, 20, 14), child: TextField(
          controller: _search,
          onChanged: (value) => setState(() => _query = value),
          decoration: InputDecoration(hintText: 'Rechercher un joueur...', prefixIcon: const Icon(Icons.search_rounded), filled: true, fillColor: Colors.white, contentPadding: const EdgeInsets.symmetric(vertical: 14), border: OutlineInputBorder(borderRadius: BorderRadius.circular(15), borderSide: BorderSide.none)),
        )),
        Expanded(child: ListView(padding: const EdgeInsets.fromLTRB(20, 0, 20, 20), children: [
          Row(children: [const Expanded(child: Text('Tous les joueurs', style: TextStyle(fontSize: 20, fontWeight: FontWeight.w800, color: _navy))), Container(padding: const EdgeInsets.symmetric(horizontal: 11, vertical: 6), decoration: BoxDecoration(color: const Color(0xFFE2F5EC), borderRadius: BorderRadius.circular(20)), child: Text('${visible.length}', style: const TextStyle(color: _green, fontWeight: FontWeight.w700)))]),
          const SizedBox(height: 12),
          if (visible.isEmpty) const Padding(padding: EdgeInsets.all(28), child: Text('Aucun joueur trouvé.', textAlign: TextAlign.center, style: TextStyle(color: Color(0xFF778497)))),
          ...visible.map((player) => Padding(padding: const EdgeInsets.only(bottom: 10), child: _PlayerCard(player: player, onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => _PlayerDetailPage(player: player)))))),
        ])),
      ])),
    );
  }
}

class _Player {
  const _Player(this.firstName, this.lastName, this.number, this.position, this.age, this.speed, this.stamina, this.technique, this.strength);
  final String firstName, lastName, position;
  final int number, age, speed, stamina, technique, strength;
  String get fullName => '$firstName $lastName';
  int get rating => (speed + stamina + technique + strength) ~/ 4;
}

class _PlayerCard extends StatelessWidget {
  const _PlayerCard({required this.player, required this.onTap});
  final _Player player;
  final VoidCallback onTap;
  @override
  Widget build(BuildContext context) => Card(margin: EdgeInsets.zero, color: Colors.white, elevation: 0, shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(17), side: const BorderSide(color: Color(0xFFE8EDF2))), child: InkWell(borderRadius: BorderRadius.circular(17), onTap: onTap, child: Padding(padding: const EdgeInsets.all(14), child: Row(children: [
    CircleAvatar(radius: 25, backgroundColor: const Color(0xFFE2F5EC), child: Text('${player.number}', style: const TextStyle(color: _green, fontWeight: FontWeight.w800))),
    const SizedBox(width: 13), Expanded(child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Text(player.fullName, style: const TextStyle(fontSize: 15, fontWeight: FontWeight.w700, color: _navy)), const SizedBox(height: 5), Text('${player.position}  ·  ${player.age} ans', style: const TextStyle(fontSize: 12, color: Color(0xFF778497)))])),
    Container(width: 39, height: 39, alignment: Alignment.center, decoration: BoxDecoration(color: const Color(0xFFFFF4DE), borderRadius: BorderRadius.circular(13)), child: Text('${player.rating}', style: const TextStyle(color: Color(0xFFC78216), fontWeight: FontWeight.w800))), const SizedBox(width: 4), const Icon(Icons.chevron_right_rounded, color: Color(0xFF9AA6B2)),
  ]))));
}

class _PlayerDetailPage extends StatelessWidget {
  const _PlayerDetailPage({required this.player});
  final _Player player;
  @override
  Widget build(BuildContext context) => Scaffold(backgroundColor: const Color(0xFFF5F7FA), appBar: AppBar(title: const Text('Détail du joueur'), backgroundColor: const Color(0xFFF5F7FA), foregroundColor: _navy), body: ListView(padding: const EdgeInsets.all(20), children: [
    Container(padding: const EdgeInsets.all(22), decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(20)), child: Column(children: [
      CircleAvatar(radius: 42, backgroundColor: const Color(0xFFE2F5EC), child: Text('${player.number}', style: const TextStyle(fontSize: 27, color: _green, fontWeight: FontWeight.w800))),
      const SizedBox(height: 12), Text(player.fullName, style: const TextStyle(fontSize: 22, fontWeight: FontWeight.w800, color: _navy)),
      const SizedBox(height: 5), Text('${player.position}  ·  ${player.age} ans', style: const TextStyle(color: Color(0xFF778497))),
      const SizedBox(height: 20),
      _SkillBar(label: 'Vitesse', value: player.speed), _SkillBar(label: 'Endurance', value: player.stamina), _SkillBar(label: 'Technique', value: player.technique), _SkillBar(label: 'Force physique', value: player.strength),
    ])),
    const SizedBox(height: 16),
    Container(padding: const EdgeInsets.all(18), decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(18)), child: const Row(children: [Icon(Icons.groups_rounded, color: _green), SizedBox(width: 12), Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Text('Équipe', style: TextStyle(color: Color(0xFF778497), fontSize: 12)), Text('Les Aigles', style: TextStyle(color: _navy, fontWeight: FontWeight.w700))])])),
  ]));
}

class _SkillBar extends StatelessWidget {
  const _SkillBar({required this.label, required this.value});
  final String label;
  final int value;
  @override
  Widget build(BuildContext context) => Padding(padding: const EdgeInsets.only(top: 13), child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Row(children: [Expanded(child: Text(label, style: const TextStyle(color: Color(0xFF617084)))), Text('$value', style: const TextStyle(color: _navy, fontWeight: FontWeight.w700))]), const SizedBox(height: 7), ClipRRect(borderRadius: BorderRadius.circular(8), child: LinearProgressIndicator(value: value / 100, minHeight: 7, backgroundColor: const Color(0xFFEAF0F3), color: _green))]));
}