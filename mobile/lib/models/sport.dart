// Ces modèles convertissent les champs JSON de l'API en données Dart.
int entier(dynamic valeur) =>
    valeur is num ? valeur.toInt() : int.parse(valeur.toString());

class Equipe {
  Equipe.fromJson(Map<String, dynamic> json)
    : id = entier(json['id_equipe']),
      nom = json['nom_equipe'] as String,
      coach = json['coach_nom'] as String? ?? 'Non renseigné',
      dateCreation = json['date_creation'] as String,
      couleur = json['couleur'] as String? ?? '#31B879',
      effectif = json['joueurs'] is List
          ? (json['joueurs'] as List).length
          : entier(json['nb_joueurs'] ?? 0);

  final int id, effectif;
  final String nom, coach, dateCreation, couleur;
}

class Joueur {
  Joueur.fromJson(Map<String, dynamic> json)
    : id = entier(json['id_joueur']),
      prenom = json['prenom'] as String,
      nom = json['nom'] as String,
      poste = json['poste_nom'] as String? ?? 'Non renseigné',
      equipe = json['equipe_nom'] as String? ?? 'Sans équipe',
      age = json['age'] == null ? null : entier(json['age']),
      numero = json['numero'] == null ? null : entier(json['numero']),
      vitesse = entier(json['vitesse']),
      endurance = entier(json['endurance']),
      technique = entier(json['technique']),
      force = entier(json['force_physique']),
      blesse =
          json['est_blesse'] == true || json['est_blesse'].toString() == '1';

  final int id, vitesse, endurance, technique, force;
  final int? age, numero;
  final String prenom, nom, poste, equipe;
  final bool blesse;
  String get nomComplet => '$prenom $nom';
}
