import 'package:flutter/material.dart';
import 'groupe.dart';
import 'joueur.dart';

void main() => runApp(const SportManagerApp());

class SportManagerApp extends StatelessWidget {
  const SportManagerApp({super.key});

  @override
  Widget build(BuildContext context) {
    const navy = Color(0xFF142B45);
    const green = Color(0xFF31B879);

    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Sport Manager',
      theme: ThemeData(
        useMaterial3: true,
        scaffoldBackgroundColor: const Color(0xFFF5F7FA),
        colorScheme: ColorScheme.fromSeed(seedColor: green),
        fontFamily: 'Roboto',
      ),
      home: const MainNavigation(),
    );
  }
}

class MainNavigation extends StatefulWidget {
  const MainNavigation({super.key});

  @override
  State<MainNavigation> createState() => _MainNavigationState();
}

class _MainNavigationState extends State<MainNavigation> {
  int _selectedIndex = 1;

  static const _pages = [
    GroupPage(),
    HomePage(),
    PlayerPage(),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: IndexedStack(index: _selectedIndex, children: _pages),
      ),
      bottomNavigationBar: NavigationBar(
        selectedIndex: _selectedIndex,
        onDestinationSelected: (index) => setState(() => _selectedIndex = index),
        destinations: const [
          NavigationDestination(
            icon: Icon(Icons.groups_outlined),
            selectedIcon: Icon(Icons.groups),
            label: 'Groupes',
          ),
          NavigationDestination(
            icon: Icon(Icons.home_outlined),
            selectedIcon: Icon(Icons.home_rounded),
            label: 'Accueil',
          ),
          NavigationDestination(
            icon: Icon(Icons.person_outline_rounded),
            selectedIcon: Icon(Icons.person_rounded),
            label: 'Joueurs',
          ),
        ],
      ),
    );
  }
}

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 28),
      child: Center(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Container(
              width: 96,
              height: 96,
              decoration: BoxDecoration(
                color: const Color(0xFFE2F5EC),
                borderRadius: BorderRadius.circular(30),
              ),
              child: const Icon(
                Icons.sports_soccer_rounded,
                color: Color(0xFF31B879),
                size: 54,
              ),
            ),
            const SizedBox(height: 26),
            const Text(
              'SPORT MANAGER',
              textAlign: TextAlign.center,
              style: TextStyle(
                color: Color(0xFF142B45),
                fontSize: 30,
                fontWeight: FontWeight.w800,
                letterSpacing: 1.4,
              ),
            ),
            const SizedBox(height: 10),
            const Text(
              'Gérez votre équipe en toute simplicité',
              textAlign: TextAlign.center,
              style: TextStyle(color: Color(0xFF718096), fontSize: 15),
            ),
          ],
        ),
      ),
    );
  }
}

