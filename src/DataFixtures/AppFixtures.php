<?php

namespace App\DataFixtures;

use App\Entity\Attribut;
use App\Entity\AvantageInconvenient;
use App\Entity\Clan;
use App\Entity\Discipline;
use App\Entity\Pouvoir;
use App\Entity\Predateur;
use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brujah = new Clan();
        $brujah->setNom('Brujah');
        $brujah->setFaiblesse('Enlève un nombre de dés égal au score de fléau à leurs jets de resistance à la frénésie.');
        $brujah->setLore('Le clan des Philosophes rêve d’un monde pur de 
        toute injustice, où les vivants et les non-morts 
        pourraient cohabiter en paix. Les Brujahs affirment qu’ils poussent les mortels à la révolte 
        contre leurs maîtres par amour pour les humains. En réalité, il se pourrait qu’ils hurlent juste leur colère contre un 
        Dieu trop distant ou inexistant qu’ils ne pourront jamais 
        combattre, contre une malédiction qu’ils ne pourront jamais lever. Leur rêve corrompt tout ce qu’il touche. Lorsqu’ils s’infiltrent au sein d’une révolution ou la suscitent, 
        leur Soif et leur passion garantissent que le sang va couler, 
        que des innocents vont mourir et que la paix ne sera jamais 
        conclue.Le clan Brujah a toujours étreint dans les rangs des sympathisants aux contre-cultures et à la révolte. Les Brujahs 
        recherchent des alliés qui remettent en question les idées 
        normatives et, comme ils admirent le feu des opprimés, ils 
        gravitent autour des marginaux.
        Les idées reçues parmi les vampires décrivent les Brujahs 
        comme des punks, des membres de gangs, des immigrés 
        mal intégrés rejetés par la société qui devrait les protéger 
        et des émeutiers brandissant des banderoles et lançant des 
        cocktails Molotov. Le clan inclut effectivement un bon 
        nombre d’outsiders bruyants et voyants, mais son désir 
        de rébellion est bien plus profond et inclut le fraudeur 
        escroquant sa propre entreprise, l’avocat représentant les 
        pauvres gratuitement, le néonazi prétendant faire partie 
        de la «nouvelle droite» et le reclus dans sa cave téléchargeant illégalement des milliers de films pour les redistribuer sur des sites de streaming. Les novices étreints pour 
        se battre et protester sont souvent appelés des Canailles.
        Les Brujahs peuvent être des combattants passionnés, 
        mais aussi des penseurs critiques; les activistes du clan sont 
        souvent très différents de ses théoriciens. Dans bien des cas, 
        ces derniers sont d’anciens étudiants en sociologie ou ayant 
        travaillé sur le thème des inégalités entre les sexes, des personnes ayant survécu à une expérience de mort imminente 
        et des gens qui ont subi et supporté d’autres grandes tragédies personnelles. Les Brujahs philosophes, appelés les 
        Hellènes, croient que le meilleur moyen de détruire la 
        classe dominante est de comprendre les systèmes sociaux 
        et culturels qui lui permettent d’exister à la base.');
        $manager->persist($brujah);

        $gangrel = new Clan();
        $gangrel->setNom('Gangrel');
        $gangrel->setFaiblesse('L\'orsqu\'ils entrent en frénésie, ils gagnent pour deux nuits un nombre de traits physique ou comportemental animal égal au score de fléau. Chaque trait réduit un attribut de 1');
        $gangrel->setLore('Les membres du clan gangrel sont des 
        parias, des vagabonds, des voyous et 
        des chasseurs. Ils ont leurs refuges 
        dans les parties les plus pauvres de la 
        ville et n’en éprouvent aucune honte. 
        Ils revendiquent peu de domaines, 
        mais ils n’obéissent à aucun prince. 
        Si un Féroce pénètre dans une ville, 
        le prince doit soit l’accepter, soit le 
        combattre pour qu’il s’en aille.
        Les Gangrels étreignent parmi les 
        survivants et les combattants: les 
        chefs de gangs de rues et de prisons, 
        les explorateurs (urbains ou non) et 
        tout mortel considérant le monde 
        comme quelque chose qu’il veut parcourir et non fuir. Ils se moquent 
        des apparences et des titres, mais ils 
        jugent sur les réussites et la réputation. Un infant peut être aussi rebelle 
        qu’il le veut, le clan lui fait subir des 
        rituels et des initiations pour s’assurer que le novice en vaut la peine. S’il 
        réussit, il devient un nouveau membre 
        honorable du clan. S’il échoue, il n’est 
        plus qu’un rebut aussitôt oublié, voire 
        un tas de cendres.
        Tout mortel capable d’imposer 
        sa volonté aux autres, de mener un 
        groupe du désastre au succès ou de 
        relever des défis insurmontables 
        attire l’attention du clan. Ce fait 
        génère un syndrome de «surplus de 
        chefs», car le clan est davantage composé de leaders que de suiveurs. Les 
        coutumes des Gangrels encouragent 
        la détermination de la hiérarchie par 
        le combat, mais ces affrontements 
        vont rarement jusqu’à la Mort ultime, 
        car les anciens parmi les Loups déconseillent aux nouveau-nés de transformer la compétition pour l’autorité en 
        rancune personnelle et militent pour 
        une culture de rivalité saine.');
        $manager->persist($gangrel);

        $malkavien = new Clan();
        $malkavien->setNom('Malkavien');
        $malkavien->setFaiblesse('Souffre d’au moins une maladie mentale. Si échec bestial ou Compulsion retire un nombre de dés égal score de Fléau à une catégorie de groupement de dés pour le reste de la scène.');
        $malkavien->setLore('Les autres vampires sont depuis longtemps persuadés, à tort, que rares 
        sont les familles de Descendants aussi 
        disparates que le clan de la Lune. En 
        voyant les Déments, les autres clans 
        se disent qu’étant donné qu’ils sont 
        tous fous leurs origines respectives 
        n’ont pas vraiment d’importance. 
        Mais pour les Malkaviens, les origines sont en fait très importantes. 
        Les sires et les dames peuvent choisir 
        des infants de tous les milieux, âges, 
        ethnies et sexes possibles, mais tous 
        les mortels que les Malkaviens étreignent possèdent quelque chose que 
        seul un Fou peut voir.
        L’un des dons que les Malkaviens 
        recherchent chez un humain est ce 
        qu’ils appellent la «seconde vue». 
        Si une personne interprète les rêves, 
        peut percevoir les esprits ou prédit 
        les événements futurs avec exactitude, les Déments la remarqueront. 
        Cette personne est un phare dans la 
        nuit qui attire tous les Lunatiques qui 
        la croisent.
        Un autre don révéré par les 
        Bouffons est la «clairvoyance». Un 
        degré élevé d’empathie, une connaissance fine d’un sujet complexe ou 
        simplement un besoin obsessionnel 
        de chercher les réponses à des questions philosophiques sont des qualités attrayantes pour le clan. Étant 
        donné que cette clairvoyance est souvent liée à la carrière professionnelle, 
        le clan inclut une grande variété 
        d’universitaires et de médecins, en 
        particulier des thérapeutes et des 
        psychologues.Enfin, les Derviches sont fascinés par les personnes «brisées»: 
        des individus ayant été changés par 
        des expériences traumatisantes ou 
        qui sont simplement nés légèrement 
        déconnectés d’eux-mêmes et du reste 
        de la société. Pour les Malkaviens, ces 
        personnes n’ont besoin que d’un petit 
        coup de pouce pour accéder à une 
        dimension de réalité totalement différente. Au lieu de les traiter comme 
        des fardeaux, le clan les considère 
        comme des individus avec beaucoup 
        de potentiel.
        Tous les Malkaviens souffrent 
        d’une maladie mentale après leur 
        Étreinte. Parfois, une affliction existante s’aggrave, d’autres fois, une 
        nouvelle dimension s’ajoute à l’instabilité du jeune vampire. Impossible 
        de savoir quand l’état d’un Malkavien 
        se manifestera de manière destructrice et quand il offrira de nouvelles 
        perspectives cruciales concernant un 
        problème, comme si les pensées et les 
        actions des Déments étaient basées 
        sur une logique totalement étrangère à la nôtre. De manière générale, 
        aucun Descendant ne se sent totalement à l’aise en compagnie d’un 
        vampire qu’il sait être malkavien. Les 
        autres clans considèrent souvent les 
        Oracles comme des timbrés imprévisibles, le danger de leurs crises de 
        démence pesant bien plus lourd que 
        l’utilité de leurs éclairs de génie.
        Certains Malkaviens affirment que 
        la folie du clan possède un dénominateur commun, qu’ils sont tous reliés 
        par un canal télépathique partagé, 
        une sorte de conscience collective. 
        Ceux qui connaissent son existence 
        l’appellent la Toile d’araignée ou, à 
        l’époque moderne, le Réseau de la 
        folie');
        $manager->persist($malkavien);

        $nosferatus = new Clan();
        $nosferatus->setNom('Nosferatus');
        $nosferatus->setFaiblesse('Les Nosferatus sont hideux. Repoussant niveau 2. Pénalité égale au score de fléaux pour TOUTE tentative de se déguiser en humain.');
        $nosferatus->setLore('Pour les Nosferatus, l’Étreinte est une descente 
        vertigineuse dans l’abjection, car le Sang de 
        l’Horreur déforme graduellement et malgré leur 
        résistance les tissus de leur corps humain en une 
        abomination grotesque. Pendant des semaines de souffrance, des difformités similaires à d’horribles anomalies 
        congénitales, à des tumeurs cancéreuses, à des blessures invalidantes ou à des plaies de lèpre apparaissent. Ceux qui 
        subissent ce processus deviennent des échos monstrueux 
        de la version du vampire imaginée par Murnau sur grand 
        écran. Mais peut-être que la douleur et l’humiliation enseignent la compassion, car, de tous les Descendants, les 
        Nosferatus (ils se font appeler ainsi parce qu’ils préfèrent 
        en rire) sont les plus charitables. Ils portent leur malédiction à l’extérieur plutôt qu’à l’intérieur. Pour se mêler aux 
        mortels, certains font appel au Sang afin de porter les visages empruntés à leurs victimes ou de disparaître de la 
        vue des observateurs, tandis que d’autres utilisent des prothèses et beaucoup de maquillage.');
        $manager->persist($nosferatus);

        $toreadors = new Clan();
        $toreadors->setNom('Toréadors');
        $toreadors->setFaiblesse('Lorsque votre personnage se trouve dans un environnement qui n’est pas beau, pénalité égal à son score de Fléau à ses dés de disciplines. Un échec bestial déclenche souvent une fascination.');
        $toreadors->setLore('Le clan Toréador a toujours prêché la 
        sélectivité concernant l’Étreinte. Les 
        anciens du clan insistent régulièrement sur le fait que les Divas veulent 
        les pionniers de tous les domaines 
        artistiques et l’avant-garde de 
        manière générale. Les Arikélites sont 
        à leur meilleur lorsqu’ils sont composés des penseurs les plus novateurs et 
        de ceux ayant soif d’expérimentation 
        et de découvertes esthétiques. C’est 
        pourquoi beaucoup de Toréadors 
        sont choisis parmi les artistes accomplis, qu’ils soient récemment découverts ou passés de mode. Mais tous 
        les artistes ne manient pas nécessairement le pinceau: pour les Toréadors, 
        l’art inclut toutes les formes de divertissement et de stimulation. Le clan 
        courtise les plus grands acteurs, chanteurs, écrivains, danseurs et même 
        travailleurs du sexe si les Dégénérés 
        sont d’avis que ces mortels offriront 
        quelque chose de nouveau à leur 
        famille.
        Malgré la coutume de n’étreindre 
        que la crème de la crème, l’obsession 
        des Toréadors pour la beauté et l’innocence a poussé beaucoup de Divas à 
        créer un infant de manière irréfléchie. 
        Bien des fois, sous la lumière de la 
        lune, de nouveaux Artistes se sont 
        révélés être des hédonistes superficiels, des chanteurs incapables de sortir plus d’un tube ou simplement des 
        beautés stupéfiantes n’ayant aucune 
        autre qualité notable. Les erreurs 
        les plus grossières sont effacées et 
        oubliées, mais le clan reste diversifié 
        car ses membres considèrent qu’il est 
        bon que l’ensemble soit un kaléidoscope de talents et de beautés.');
        $manager->persist($toreadors);

        $tremere = new Clan();
        $tremere->setNom('Tremere');
        $tremere->setFaiblesse('Pour lier au sang la cible doit boire la vitae un nombre de fois supplémentaires égal au score de Fléau du vampire. Ne peut pas lier au sang un autre vampire.');
        $tremere->setLore('Après la destruction de la Première 
        Fondation par la Seconde Inquisition 
        à Vienne en 2008, les Tremeres sont 
        passés d’éminences grises à personae non gratae dans beaucoup de 
        régions. L’arrogance de la Pyramide 
        avait valu beaucoup d’ennemis aux 
        Usurpateurs. Mais l’utilité de la sorcellerie n’a pas disparu; en fait, elle 
        augmente au fur et à mesure que le 
        Sang maudit change dans les veines 
        des Descendants.
        Sans la Pyramide pour déterminer 
        leur rang et leur valeur, les Sorciers 
        se retrouvent en compétition avec 
        les autres Descendants et, de plus 
        en plus, avec les autres Sorciers pour 
        obtenir tout ce qui pourrait leur permettre de regagner une partie de leur 
        ancienne puissance. La chasse aux 
        artefacts et aux grimoires appartenant aux anciens tremeres désormais 
        réduits en cendres est pratiquée par 
        tout le clan et rivalise de brutalité 
        avec ses intrigues sociales. L’alliance 
        avec la Camarilla est une arme que 
        les maisons du clan Tremere utilisent 
        souvent les unes contre les autres. 
        Dans le même temps, le terme «mage 
        mercenaire» est de plus en plus 
        répandu car les Sorciers autrefois 
        liés par la volonté de leurs maîtres 
        se retrouvent libres de servir qui ils 
        veulent au prix de leur choix.
        Les Tremeres servent de trois 
        manières: ils servent les autres clans 
        en leur apportant leur expertise 
        occulte, ils servent la Camarilla en 
        lui fournissant la Sorcellerie du sang 
        et ils servent leurs propres intérêts 
        en cherchant à prendre le pouvoir. 
        Même si les Tremeres s’emparant de 
        la praxis sont aujourd’hui plus nombreux que jamais, ils continuent d’occuper moins de trônes dans le monde 
        que le clan Nosferatu. En vérité, la 
        plupart des Usurpateurs admettent 
        que devenir prince n’est utile que si 
        cela les aide à étendre leurs connaissances. Pour les Tremeres, le véritable pouvoir consiste à connaître 
        les manières de modeler le monde, à 
        avoir accès au bon sang et à posséder 
        les artefacts anciens les plus rares.Les Tremeres peuvent s’allier à des 
        coteries en pleine confusion qui le 
        leur proposent, traquer des reliques 
        et des artefacts bien protégés ou analyser soigneusement des fragments de 
        savoir concernant le mythe de Caïn 
        (tout en gardant jalousement leurs 
        secrets face aux autres Tremeres), 
        mais ils sont tous unis par leur soif 
        de connaissance. Un Descendant qui 
        veut comprendre une parcelle de son 
        histoire a tout intérêt à consulter les 
        Tremeres pour obtenir des réponses, 
        si tant est qu’il accepte de partager 
        quelques-uns de ses propres secrets, 
        consciemment ou non.');
        $manager->persist($tremere);

        $ventrues = new Clan();
        $ventrues->setNom('Ventrues');
        $ventrues->setFaiblesse('Doit se nourrir d\'une catégorie de victime prédéfinie sauf paiement de point de volonté égal au score de fléaux. Test de résolution+vigilance difficulté 4 pour savoir si la cible possède ce sang.');
        $ventrues->setLore('Les Sang bleu ont longtemps été les dirigeants de la 
        Camarilla et occupent davantage de positions d’autorité que tout autre clan. Et ils ne veulent pas céder leur 
        place. Même après avoir perdu leur représentant le plus 
        éminent sous les griffes d’un Brujah, les Ventrues continuent d’affirmer qu’ils sont destinés à régner sur tous les 
        Descendants, peu importe les sacrifices nécessaires.
        Les Ventrues croient à la force de la tradition et du 
        lignage. L’Étreinte est l’un de leurs rituels les plus importants et la qualité du choix de l’infant influe sur la manière 
        dont les autres membres du clan traitent le sire. Les 
        Patriciens veulent donc étreindre des perfectionnistes, des 
        mortels possédant de la puissance politique ou financière 
        ou des gens dotés d’un talent qui les distingue des masses.
        À notre époque, les Ventrues sont prudents. Les moins 
        compétents perdent leur puissance, tandis que les meilleurs se mêlent à l’humanité en tant que banquiers, directeurs anonymes, magnats reclus et chefs du personnel. 
        Un Ventrue ne peut plus diriger ouvertement un conseil d’administration ou 
        occuper un poste attirant l’attention 
        au sein d’une communauté mortelle. 
        Ils détestent devoir influencer leur 
        environnement depuis les ombres, 
        mais ils savent que le risque d’une 
        violation fatale de la Mascarade est 
        trop élevé pour tenter quoi que ce 
        soit d’autre.
        Les Ventrues sont la classe dominante. Ils fixent les règles et les maintiennent en place, punissent ceux qui 
        les violent et parfois récompensent 
        ceux qui les suivent. Leurs détracteurs 
        les considèrent comme des tyrans 
        ou comme les geôliers des autres 
        Descendants. Cependant, la vérité, si 
        dérangeante qu’elle soit, est que sans 
        eux la Mascarade serait tombée voilà 
        bien longtemps, et la Camarilla avec 
        elle. À présent, les Ventrues sont plus 
        fidèles à leur cause que jamais auparavant. L’adversité ne fait que renforcer 
        leur détermination à gagner et leur 
        certitude qu’ils ont le droit de faire 
        tout ce qui est nécessaire pour cela');
        $manager->persist($ventrues);

        $caitiffs = new Clan();
        $caitiffs->setNom('Caitiffs');
        $caitiffs->setFaiblesse('Handicap suspect niveau 1. Ne peut pas avoir de points dans l\'historique statut à la création. Tout les pouvoirs coûtes 6 fois le niveau acheté.');
        $caitiffs->setLore('Beaucoup de Descendants supposent à tort que tous les 
        Caitiffs sont créés par accident et que les Sans clan n’étreignent jamais de mortels. 
        Cette vision des choses est obsolète et teintée d’ignorance. À notre époque, les Sans clan 
        sont de plus en plus une force avec laquelle il faut compter. Même s’ils sont plus disparates, plus individualistes et 
        moins organisés que leurs cousins, ce sont tous des survivants et ils ont commencé à se rassembler, à nouer des 
        alliances et à créer leurs propres infants.
        Les Caitiffs qui cherchent des mortels à étreindre choisissent généralement des personnes déterminées et habituées aux épreuves particulièrement dures. Un Caitiff est 
        situé tout en bas de la hiérarchie des Descendants, juste 
        au-dessus du Sang Clair qui ne devrait même pas pouvoir 
        exister, et il est forcé de se battre pour se tailler une place 
        s’il ne veut pas disparaître et être oublié. Les Caitiffs ne 
        voient pas l’intérêt d’étreindre un mortel qui a peu de 
        chances de survivre une nuit seul.
        Même si les Caitiffs ont commencé à augmenter volontairement leurs effectifs, la plupart sont toujours créés 
        lorsqu’un novice étreint par un membre de l’un des clans 
        ne forme pas d’attachement à son Sang ancestral et ne 
        présente pas les signes distinctifs de la malédiction de 
        son clan.');
        $manager->persist($caitiffs);

        $sangc = new Clan();
        $sangc->setNom('Sang Clairs');
        $sangc->setFaiblesse('Si diablerise un vampire, il prend son clan.');
        $sangc->setLore('Les sires ordonnent à leurs infants de treizième et de quatorzième génération de ne jamais tenter d’étreindre, car 
        leur Sang est trop éloigné de celui de Caïn. Ils affirment 
        que cela n’entraînerait que la mort et le chagrin. Mais que 
        ce soit par erreur ou à dessein, cet édit n’est pas toujours 
        suivi.
        Un Descendant de quatorzième génération, dont c’est un 
        miracle qu’il ne soit pas sang clair lui-même, vide un mortel de son sang au cours d’une frénésie. Plein de remords, 
        il lui fait boire une gorgée de sa vitae, espérant envers et 
        contre tout qu’elle puisse réanimer le corps brisé.
        Une Ventrue issue d’une longue lignée de menteurs se 
        croit plus proche de son antédiluvien qu’elle ne l’est réellement, et pense s’apprêter à créer un membre honorable 
        de son clan.
        L’arrière-petit-infant d’un prince tente de faire avaler sa 
        vitae faible à la goule traîtresse que son ancêtre vient d’exécuter, juste pour se venger de ce vieux tyran.');
        $manager->persist($sangc);

        $lasombra = new Clan();
        $lasombra->setNom('Lasombra');
        $lasombra->setFaiblesse('Apparait flou dans les reflets et bugué dans les enregistrement. Jet de technologie : difficulté +2 plus fléau');
        $lasombra->setLore('Lasombra sires favor mortals who fit the mold of 
        the clan. The Lasombra have been of a Darwinian philosophy since before the term existed. They have no time 
        for weakness, feel the only way to survive is to excel, and 
        cut away the trappings of sympathy and petty morality 
        wherever it might slow down their ascent to power.
        The Lasombra Embrace those who fight against the 
        odds, survive dangerous situations, and exist at the pinnacle of excellence. The Magisters describe their Embrace 
        tradition as “targeting those fit for more than a simple 
        human life.” Sociopaths, counter-culturalists, deviants, and 
        scarred survivors all hold appeal for the Lasombra. Anyone 
        who can say they have seen the dark on the other side, and 
        subsequently came back stronger, is a potential candidate 
        for the Embrace. Many become vampires obsessed with 
        the accumulation of social power, prepared to mislead and 
        use mortals to elevate themselves. Others were like that 
        before the Embrace, with such pragmatic traits leading to 
        their ascent in Lasombra eyes.
        The Lasombra lean heavily into the institutions 
        of organized religion to find their prospective childer. 
        They do not look for the truly faithful, or the truly
        depraved, but the priests who gained their role through 
        a desire to have complete control over the spiritual 
        destination of their congregations. Those nuns, monks, 
        vicars, and rabbis who use their institutions as a tool to 
        increase their power, often shaking hands with gangsters behind closed doors, are the kind of cold-hearted 
        bastards Magisters adore. 
        The mortals Embraced into this clan surprise those 
        who underestimate their ability, rising to positions of 
        power in Camarilla cities more swiftly than anyone can 
        predict.');
        $manager->persist($lasombra);


        $celerite = new Discipline();
        $celerite->setNom('Célérité');
        $celerite->setDescription('Augmente la vitesse et l’agilité du vampire, peut permettre d’agir plusieurs fois pendant un combat par exemple.');
        $celerite->addClan($brujah);
        $celerite->addClan($toreadors);
        $manager->persist($celerite);

        $presence = new Discipline();
        $presence->setNom('Présence');
        $presence->setDescription('Le charme surnaturel des vampires, il est facile d’être aimé des humains grâce à ce pouvoir, un haut niveau permet de mettre à genou d’admiration même des vampires.');
        $presence->addClan($brujah);
        $presence->addClan($toreadors);
        $presence->addClan($ventrues);
        $manager->persist($presence);

        $puissance = new Discipline();
        $puissance->setNom('Puissance');
        $puissance->setDescription('Cette discipline augmente la puissance brute du vampire.');
        $puissance->addClan($brujah);
        $puissance->addClan($nosferatus);
        $puissance->addClan($lasombra);
        $manager->persist($puissance);

        $animalisme = new Discipline();
        $animalisme->setNom('Animalisme');
        $animalisme->setDescription('Permet de communiquer et commander les animaux.');
        $animalisme->addClan($gangrel);
        $animalisme->addClan($nosferatus);
        $manager->persist($animalisme);

        $proteisme = new Discipline();
        $proteisme->setNom('Protéisme');
        $proteisme->setDescription('Cette discipline de métamorphose, utilisée surtout par les Gangrels, elle permet par exemple de faire pousser des griffes, se transformer en animal ou encore dormir dans la terre.');
        $proteisme->addClan($gangrel);
        $manager->persist($proteisme);

        $forcea = new Discipline();
        $forcea->setNom('Force d\'âme');
        $forcea->setDescription('La résistance surnaturelle des vampires.');
        $forcea->addClan($gangrel);
        $forcea->addClan($ventrues);
        $manager->persist($forcea);

        $auspex = new Discipline();
        $auspex->setNom('Auspex');
        $auspex->setDescription(' Augmentation des sens vampiriques, voir psychométrie.');
        $auspex->addClan($malkavien);
        $auspex->addClan($toreadors);
        $auspex->addClan($tremere);
        $manager->persist($auspex);

        $domination = new Discipline();
        $domination->setNom('Domination');
        $domination->setDescription(' Permet de donner des ordres aux humains ou vampires, mais ne fonctionne pas sur les vampires de sang plus fort.');
        $domination->addClan($malkavien);
        $domination->addClan($tremere);
        $domination->addClan($ventrues);
        $domination->addClan($lasombra);
        $manager->persist($domination);

        $occultation = new Discipline();
        $occultation->setNom('Occultation');
        $occultation->setDescription('Astuce ou Résolution + Auspex en opposition avec l’Astuce + Occultation de l’individu dissimulé.  Sert à se cacher aux yeux des autres, mais ce n’est pas de l’invisibilité, c’est une discipline mentale.');
        $occultation->addClan($malkavien);
        $occultation->addClan($nosferatus);
        $manager->persist($occultation);

        $sorcsang = new Discipline();
        $sorcsang->setNom('Sorcellerie du sang');
        $sorcsang->setDescription('La sorcellerie du sang fait référence à la magie des vampires. Discipline ne pouvant pas être apprise ou développée sans professeur.');
        $sorcsang->addClan($tremere);
        $manager->persist($sorcsang);

        $alchim = new Discipline();
        $alchim->setNom('Alchimie du sang clair');
        $alchim->setDescription('L\'alchimie du sang clair est un pratique en deux étapes. La distillation puis la concoction. L\'effet est activé à la consommation de la décoction.');
        $alchim->addClan($sangc);
        $manager->persist($alchim);

        $oblivion = new Discipline();
        $oblivion->setNom('Oblivion');
        $oblivion->setDescription('La discipline phare des Lasombras qui permet de manipuler les ombres. Discipline concernant les morts, les fantômes, etc.');
        $oblivion->addClan($lasombra);
        $manager->persist($oblivion);

        $lierfam = new Pouvoir();
        $lierfam->setNom('Lier le famulus');
        $lierfam->setDescription('Quand il crée un lien de sang avec un animal, le vampire peut le transformer en famulus. Il établit ainsi avec la créature une connexion mentale qui facilite au passage l’utilisation d’autres pouvoirs d’Animalisme.');
        $lierfam->setDiscipline($animalisme);
        $lierfam->setNiveau(1);
        $manager->persist($lierfam);

        $sentirbete = new Pouvoir();
        $sentirbete->setNom('Sentir la bête');
        $sentirbete->setDescription('Jet de Résolution + Animalisme en opposition avec le Sang-froid + Subterfuge de sa cible. En cas de réussite, l’utilisateur sent le degré d’agressivité de la cible. Permet de discerner une bête surnaturelle.');
        $sentirbete->setDiscipline($animalisme);
        $sentirbete->setNiveau(1);
        $manager->persist($sentirbete);

        $murmuresauv = new Pouvoir();
        $murmuresauv->setNom('Murmure sauvage');
        $murmuresauv->setDescription('Coût : un test de soif. Pour persuader un animal d’effectuer une action précise, il faut réaliser un jet de Manipulation + Animalisme dont la difficulté varie.');
        $murmuresauv->setDiscipline($animalisme);
        $murmuresauv->setNiveau(2);
        $manager->persist($murmuresauv);

        $dompterbete = new Pouvoir();
        $dompterbete->setNom('Dompter la bête');
        $dompterbete->setDescription('Coût : un test de soif. Jet de Charisme + Animalisme en opposition avec la Vigueur + Résolution de sa cible. En cas de victoire face à un mortel, la victime est neutralisée pour la scène, plongée dans une profonde léthargie.');
        $dompterbete->setDiscipline($animalisme);
        $dompterbete->setNiveau(3);
        $manager->persist($dompterbete);

        $festinanim = new Pouvoir();
        $festinanim->setNom('Festin animal');
        $festinanim->setDescription('sa Soif de 1 point supplémentaire quand il se nourrit d’un animal. Son niveau de Puissance du sang compte comme étant inférieur de 2 points en ce qui concerne les pénalités liées à cette source d’alimentation.Il réduit sa Soif de 4 niveaux s’il absorbe le sang de son famulus.');
        $festinanim->setDiscipline($animalisme);
        $festinanim->setNiveau(3);
        $manager->persist($festinanim);

        $essaimserv = new Pouvoir();
        $essaimserv->setNom('Essaim Serviteur');
        $essaimserv->setDescription('l’Essaim serviteur permet d’utiliser les pouvoirs précédemment réservés aux vertébrés sur une nuée d’insectes, qu’on considère du point de vue des règles comme une seule entité.');
        $essaimserv->setDiscipline($animalisme);
        $essaimserv->setNiveau(3);
        $manager->persist($essaimserv);

        $soumissionesprit = new Pouvoir();
        $soumissionesprit->setNom('Soumission de l\'esprit');
        $soumissionesprit->setDescription('Coût si n\'est pas utilisé sur le famulus : un test de soif .jet de Manipulation + Animalisme (difficulté 4). En cas de victoire, le vampire prend possession du corps de l’animal pendant une scène. Si c’est une victoire critique, il peut l’occuper indéfiniment.');
        $soumissionesprit->setDiscipline($animalisme);
        $soumissionesprit->setNiveau(4);
        $manager->persist($soumissionesprit);

        $hegemonieanim = new Pouvoir();
        $hegemonieanim->setNom('Hégémonie animale');
        $hegemonieanim->setDescription('Coût : deux test de soif .Le joueur choisit un type d’animal, puis effectue un jet de Charisme + Animalisme dont la difficulté dépend de l’espèce choisie et de l’ordre donné.');
        $hegemonieanim->setDiscipline($animalisme);
        $hegemonieanim->setNiveau(5);
        $manager->persist($hegemonieanim);

        $lacherlabete = new Pouvoir();
        $lacherlabete->setNom('Lacher la bête');
        $lacherlabete->setDescription('Cout : un test de soif.Au lieu d’effectuer un jet de Volonté pour résister à une frénésie de rage ou de terreur, le joueur réalise un jet d’Astuce + Animalisme en opposition avec le Sang-froid + Résolution de la cible.En cas de victoire, la cible est prise de frénésie à la place du personnage.');
        $lacherlabete->setDiscipline($animalisme);
        $lacherlabete->setNiveau(3);
        $manager->persist($lacherlabete);

        $sensaccru = new Pouvoir();
        $sensaccru->setNom('Sens Accrus');
        $sensaccru->setDescription('Ajoute son niveau d\'auspex à ses jets de perception.');
        $sensaccru->setDiscipline($auspex);
        $sensaccru->setNiveau(1);
        $manager->persist($sensaccru);

        $sentirinvi = new Pouvoir();
        $sentirinvi->setNom('Sentir l\'invisible');
        $sentirinvi->setDescription('Le conteur effectue un jet caché d’Astuce + Auspex de la difficulté de son choix.');
        $sentirinvi->setDiscipline($auspex);
        $sentirinvi->setNiveau(1);
        $manager->persist($sentirinvi);

        $premonition = new Pouvoir();
        $premonition->setNom('Prémonition');
        $premonition->setDescription('Coût : un test de soif. Tente de provoquer une vision');
        $premonition->setDiscipline($auspex);
        $premonition->setNiveau(2);
        $manager->persist($premonition);

        $lectureame = new Pouvoir();
        $lectureame->setNom('Lecture de l\'âme');
        $lectureame->setDescription('Coût : un test de soif. Jet d’Intelligence + Auspex contre le Sang-froid + Subterfuge de sa cible. En cas de victoire, le conteur répond en toute bonne foi à autant de questions que la marge de réussite concernant l’aura et la psyché de la cible');
        $lectureame->setDiscipline($auspex);
        $lectureame->setNiveau(3);
        $manager->persist($lectureame);

        $partagesens = new Pouvoir();
        $partagesens->setNom('Partage de sens');
        $partagesens->setDescription('Coût : un test de soif. Résolution + Auspex de difficulté 3. Cette valeur peut être augmentée ou réduite selon la distance, les distractions et d’autres.');
        $partagesens->setDiscipline($auspex);
        $partagesens->setNiveau(3);
        $manager->persist($partagesens);

        $psychometrie = new Pouvoir();
        $psychometrie->setNom('Psychométrie');
        $psychometrie->setDescription('Coût : un test de soif. Jet d’Intelligence + Auspex dont la difficulté varie selon l’information recherchée.');
        $psychometrie->setDiscipline($auspex);
        $psychometrie->setNiveau(4);
        $manager->persist($psychometrie);

        $clairvoyance = new Pouvoir();
        $clairvoyance->setNom('Clairvoyance');
        $clairvoyance->setDescription('Coût : un test de faim. Jet d’Intelligence + Auspex dont la difficulté dépend du niveau de sécurité et du taux d’activité de la zone.');
        $clairvoyance->setDiscipline($auspex);
        $clairvoyance->setNiveau(5);
        $manager->persist($clairvoyance);

        $telepathie = new Pouvoir();
        $telepathie->setNom('Télépathie');
        $telepathie->setDescription('Coût : un test de soif (+1 volonté contre vampire non consentant). Résolution + Auspex contre l’Astuce + Subterfuge de la cible.');
        $telepathie->setDiscipline($auspex);
        $telepathie->setNiveau(5);
        $manager->persist($telepathie);

        $possession = new Pouvoir();
        $possession->setNom('Possession');
        $possession->setDescription('Coût : deux test de soif. Résolution + Auspex en opposition avec la Résolution + Intelligence de la cible.');
        $possession->setDiscipline($auspex);
        $possession->setNiveau(5);
        $manager->persist($possession);

        $gracefeline = new Pouvoir();
        $gracefeline->setNom('Grâce féline');
        $gracefeline->setDescription(' Réussite automatique des jets basés sur la Dextérité ou l’Athlétisme pour conserver son équilibre');
        $gracefeline->setDiscipline($celerite);
        $gracefeline->setNiveau(1);
        $manager->persist($gracefeline);

        $reflexeclair = new Pouvoir();
        $reflexeclair->setNom('Reflexes éclairs');
        $reflexeclair->setDescription('Une action supplémentaire mineur d\'une valeur de deux dés et ne souffre pas du malus d\'absence de couvert sur les jet de defense');
        $reflexeclair->setDiscipline($celerite);
        $reflexeclair->setNiveau(1);
        $manager->persist($reflexeclair);

        $travers = new Pouvoir();
        $travers->setNom('Traversée');
        $travers->setDescription('Coût : un test de soif. Le joueur effectue un jet de Dextérité + Athlétisme dont la difficulté varie de 3 à 6');
        $travers->setDiscipline($celerite);
        $travers->setNiveau(3);
        $manager->persist($travers);

        $rapidite = new Pouvoir();
        $rapidite->setNom('Rapidité');
        $rapidite->setDescription('Coût : un text de soif. Ajoute autant de dés que le niveau de Célérité de son personnage à ses groupements de dés de Dextérité qui ne sont pas relatifs au combat. Une fois par tour, l’utilisateur peut bénéficier de ce bonus lorsqu’il se défend avec un jet de Dextérité + Athlétisme');
        $rapidite->setDiscipline($celerite);
        $rapidite->setNiveau(2);
        $manager->persist($rapidite);

        $fulgu = new Pouvoir();
        $fulgu->setNom('Fulgurance');
        $fulgu->setDescription('Coût : un test de soif. En un tour, il a le temps de se déplacer de 50m et de réaliser une action à l’arrivée. Si le terrain s’avère dangereux, le personnage effectue un jet de Dextérité + Athlétisme');
        $fulgu->setDiscipline($celerite);
        $fulgu->setNiveau(3);
        $manager->persist($fulgu);

        $breuvage = new Pouvoir();
        $breuvage->setNom('Breuvage d\'élégance');
        $breuvage->setDescription('Coût : un test de soif. En absorbant assez de sang pour provoquer un test d’Exaltation, le buveur gagne la moitié des points de Célérité');
        $breuvage->setDiscipline($celerite);
        $breuvage->setNiveau(4);
        $manager->persist($breuvage);

        $tirinfaillibe = new Pouvoir();
        $tirinfaillibe->setNom('Tir infaillible');
        $tirinfaillibe->setDescription('Coût : un test de soif. Le personnage doit utiliser ce pouvoir avant d’effectuer une attaque à distance. La cible ne peut pas faire de jet pour esquiver ou se défendre; la difficulté de l’attaque est de 1. Un adversaire possédant Célérité 5 peut annuler ce pouvoir grâce à un test d’Exaltation');
        $tirinfaillibe->setDiscipline($celerite);
        $tirinfaillibe->setNiveau(4);
        $manager->persist($tirinfaillibe);

        $fracseconde = new Pouvoir();
        $fracseconde->setNom('Fraction de seconde');
        $fracseconde->setDescription('Coût : un test de soif. Permet de réagir de manière instantanée pendant le récit du conteur');
        $fracseconde->setDiscipline($celerite);
        $fracseconde->setNiveau(5);
        $manager->persist($fracseconde);

        $frappeeclair = new Pouvoir();
        $frappeeclair->setNom('Frappe éclair');
        $frappeeclair->setDescription('Coût : un test de soif.  le personnage doit utiliser ce pouvoir avant d’effectuer une attaque de Bagarre ou de Mêlée. La cible ne peut pas faire de jet pour esquiver ou se défendre; la difficulté de l’attaque est de 1.');
        $frappeeclair->setDiscipline($celerite);
        $frappeeclair->setNiveau(5);
        $manager->persist($frappeeclair);

        $brouilmemo = new Pouvoir();
        $brouilmemo->setNom('Brouillage mémoriel');
        $brouilmemo->setDescription('Charisme + Domination contre son Astuce + Résolution. Réussite auto sur un humain surpris. Brouille la mémoire');
        $brouilmemo->setDiscipline($domination);
        $brouilmemo->setNiveau(1);
        $manager->persist($brouilmemo);

        $contrainte = new Pouvoir();
        $contrainte->setNom('Contrainte');
        $contrainte->setDescription('Charisme + Domination contre Intelligence + Résolution. Réussite auto sur un humain surpris. Permet de donner un ordre');
        $contrainte->setDiscipline($domination);
        $contrainte->setNiveau(1);
        $manager->persist($contrainte);

        $hypno = new Pouvoir();
        $hypno->setNom('Hypnose');
        $hypno->setDescription('Coût : un test de soif. Manipulation + Domination contre Intelligence + Résolution. Permet de donner des consignes complexe.');
        $hypno->setDiscipline($domination);
        $hypno->setNiveau(2);
        $manager->persist($hypno);

        $alien = new Pouvoir();
        $alien->setNom('Aliénation');
        $alien->setDescription('Coût : un test de soif. Manipulation + Domination contre son Sang-froid + Intelligence afin de lui infliger des dégâts de Volonté superficiels');
        $alien->setDiscipline($domination);
        $alien->setNiveau(2);
        $manager->persist($alien);

        $altermemo = new Pouvoir();
        $altermemo->setNom('Altération mémorielle');
        $altermemo->setDescription('Coût : un test de soif. Manipulation + Domination contre l’Intelligence + Résolution. Permet d\'ajouter ou supprimer des souvenirs.');
        $altermemo->setDiscipline($domination);
        $altermemo->setNiveau(3);
        $manager->persist($altermemo);

        $injonction = new Pouvoir();
        $injonction->setNom('Injonction latente');
        $injonction->setDescription('Lance une hypnose qui se déclenche sous condition.');
        $injonction->setDiscipline($domination);
        $injonction->setNiveau(3);
        $manager->persist($injonction);

        $rationalisation = new Pouvoir();
        $rationalisation->setNom('Rationalisation');
        $rationalisation->setDescription('Jet d’Astuce + Vigilance (difficulté 5). Empêche une personne de penser avoir été sous un pouvoir de domination.');
        $rationalisation->setDiscipline($domination);
        $rationalisation->setNiveau(4);
        $manager->persist($rationalisation);

        $decret = new Pouvoir();
        $decret->setNom('Décret Ultime');
        $decret->setDescription('Lance une hypnose irrésistible. Les victimes doivent faire un jet pour résister aux injonctions fatales');
        $decret->setDiscipline($domination);
        $decret->setNiveau(5);
        $manager->persist($decret);

        $manipmass = new Pouvoir();
        $manipmass->setNom('Manipulation des masses');
        $manipmass->setDescription('Coût : pouvoir +1. Permet de lancer une compétence de domination sur plusieurs personnes et qui dure plus longtemps.');
        $manipmass->setDiscipline($domination);
        $manipmass->setNiveau(1);
        $manager->persist($manipmass);

        $resil = new Pouvoir();
        $resil->setNom('Résilience');
        $resil->setDescription('La jauge de santé est augmentée de son niveau de Force d’âme.');
        $resil->setDiscipline($forcea);
        $resil->setNiveau(1);
        $manager->persist($resil);

        $espritreso = new Pouvoir();
        $espritreso->setNom('Esprit résolu');
        $espritreso->setDescription('Un dés par niveau de force d\'âme rajouté pour résister à une tentative d\'influence contre sa volonté.');
        $espritreso->setDiscipline($forcea);
        $espritreso->setNiveau(1);
        $manager->persist($espritreso);

        $resist = new Pouvoir();
        $resist->setNom('Résistance');
        $resist->setDescription('Coût : un test de soif. Le défenseur soustrait son niveau de Force d’âme des dégâts superficiels qu’il subit.');
        $resist->setDiscipline($forcea);
        $resist->setNiveau(2);
        $manager->persist($resist);

        $beteendu = new Pouvoir();
        $beteendu->setNom('Bêtes endurantes');
        $beteendu->setDescription('Coût : un test de soif.  Les animaux concernés gagnent autant de niveaux de santé que le score de Force d’âme du personnage.');
        $beteendu->setDiscipline($forcea);
        $beteendu->setNiveau(2);
        $manager->persist($beteendu);

        $defierfleau = new Pouvoir();
        $defierfleau->setNom('Défier les fléaux');
        $defierfleau->setDescription('Coût : un test de soif. le personnage peut convertir autant de points de dégâts aggravés que son niveau de Force d’âme en dégâts superficiels.');
        $defierfleau->setDiscipline($forcea);
        $defierfleau->setNiveau(3);
        $manager->persist($defierfleau);

        $fortifiermasque = new Pouvoir();
        $fortifiermasque->setNom('Fortifier le masque');
        $fortifiermasque->setDescription('Le pouvoir accroît la difficulté de Lecture de l’âme (Auspex 3), Télépathie (Auspex 5) et des pouvoirs similaires d’un montant égal à la moitié du niveau de Force d’âme du personnage (arrondi au supérieur)');
        $fortifiermasque->setDiscipline($forcea);
        $fortifiermasque->setNiveau(3);
        $manager->persist($fortifiermasque);

        $breuvendu = new Pouvoir();
        $breuvendu->setNom('Breuvage endurance');
        $breuvendu->setDescription('Coût : un test de soif. Le buveur gagne la moitié des points de Force d’âme du donneur');
        $breuvendu->setDiscipline($forcea);
        $breuvendu->setNiveau(4);
        $manager->persist($breuvendu);

        $chairmarbre = new Pouvoir();
        $chairmarbre->setNom('Chair de marbre');
        $chairmarbre->setDescription('Côut : deux test de soif. Ignore la première source de dégâts physiques par tour mais pas les blessures provoquées par la lumière du soleil.');
        $chairmarbre->setDiscipline($forcea);
        $chairmarbre->setNiveau(5);
        $manager->persist($chairmarbre);

        $doulsalva = new Pouvoir();
        $doulsalva->setNom('Douleur salvatrice');
        $doulsalva->setDescription('Ne subit plus les malus de dés liés aux dégâts subis, comme ceux de l’Affaiblissement physique. En outre, il peut augmenter un attribut physique de +1 (les jauges restent inchangées) pour chaque niveau de dégâts aggravés ou superficiels coché sur sa jauge de santé.');
        $doulsalva->setDiscipline($forcea);
        $doulsalva->setNiveau(5);
        $manager->persist($doulsalva);

        $manteauombre = new Pouvoir();
        $manteauombre->setNom('Manteau d\'ombre');
        $manteauombre->setDescription('Le vampire se tient parfaitement immobile pour se fondre dans son environnement');
        $manteauombre->setDiscipline($occultation);
        $manteauombre->setNiveau(1);
        $manager->persist($manteauombre);

        $silencemort = new Pouvoir();
        $silencemort->setNom('Silence de la mort');
        $silencemort->setDescription(' le personnage fait taire les bruits de ses pas, de ses vêtements, de collisions mineures et tout autres sons qu’il produit avec son corps');
        $silencemort->setDiscipline($occultation);
        $silencemort->setNiveau(1);
        $manager->persist($silencemort);

        $passageinvi = new Pouvoir();
        $passageinvi->setNom('Passage invisible');
        $passageinvi->setDescription('Coût : un test de soif. Tant que le personnage n’exhale pas une odeur puissante et que les bruits qu’il produit se réduisent à un murmure, garde le manteau d\'ombre actif');
        $passageinvi->setDiscipline($occultation);
        $passageinvi->setNiveau(2);
        $manager->persist($passageinvi);

        $masquevisage = new Pouvoir();
        $masquevisage->setNom('Masque aux milles visages');
        $masquevisage->setDescription('Coût : un test de soif. Tous ceux qui croisent le vampire ne voient qu’un individu ordinaire à la tenue vestimentaire banale.');
        $masquevisage->setDiscipline($occultation);
        $masquevisage->setNiveau(3);
        $manager->persist($masquevisage);

        $fantomemachine = new Pouvoir();
        $fantomemachine->setNom('Fantôme dans la machine');
        $fantomemachine->setDescription('L\'occultation fonctionne maintenant à travers des écrans en directe.');
        $fantomemachine->setDiscipline($occultation);
        $fantomemachine->setNiveau(3);
        $manager->persist($fantomemachine);

        $disparition = new Pouvoir();
        $disparition->setNom('Disparition');
        $disparition->setDescription('Lorsque le personnage s’évanouit sous les yeux d’un mortel, son joueur effectue un jet d’Astuce + Occultation en opposition avec l’Astuce + Vigilance du témoin');
        $disparition->setDiscipline($occultation);
        $disparition->setNiveau(4);
        $manager->persist($disparition);

        $dissimul = new Pouvoir();
        $dissimul->setNom('Dissimulation');
        $dissimul->setDescription('Coût : un test de soif. Intelligence + Occultation dont la difficulté varie de 2 à 6. Dissimule un objet inanimé');
        $dissimul->setDiscipline($occultation);
        $dissimul->setNiveau(4);
        $manager->persist($dissimul);

        $imposture = new Pouvoir();
        $imposture->setNom('Imposture');
        $imposture->setDescription('Coût : un test de soif.  Astuce + Occultation et Manipulation + Représentation. Permet de se faire passer pour quelqu\'un après l\'avoir suffisement observé');
        $imposture->setDiscipline($occultation);
        $imposture->setNiveau(5);
        $manager->persist($imposture);

        $masquerassembl = new Pouvoir();
        $masquerassembl->setNom('Masquer l\'assemblée');
        $masquerassembl->setDescription('Coût : un test de soif + pouvoir. Permet d\'utiliser les pouvoir d\'occultisme sur un nombre d\'individu supplémentaire égal à son astuce');
        $masquerassembl->setDiscipline($occultation);
        $masquerassembl->setNiveau(5);
        $manager->persist($masquerassembl);

        $intimider = new Pouvoir();
        $intimider->setNom('Intimider');
        $intimider->setDescription('Ajoute la présence aux jets d\'intimidation');
        $intimider->setDiscipline($presence);
        $intimider->setNiveau(1);
        $manager->persist($intimider);

        $reverence = new Pouvoir();
        $reverence->setNom('Révérence');
        $reverence->setDescription('Ajoute la présence au jets de persuasion, représentation et charisme.');
        $reverence->setDiscipline($presence);
        $reverence->setNiveau(1);
        $manager->persist($reverence);

        $baiserpersis = new Pouvoir();
        $baiserpersis->setNom('Baiser persistant');
        $baiserpersis->setDescription(' si il le souhaite il ajoute autant de dés que son niveau de Présence à tous ses groupements basés sur le Charisme concernant la victime mordue');
        $baiserpersis->setDiscipline($presence);
        $baiserpersis->setNiveau(2);
        $manager->persist($baiserpersis);

        $regardterrifiant = new Pouvoir();
        $regardterrifiant->setNom('Regard terrifiant');
        $regardterrifiant->setDescription('Coût : un test de soif.  Charisme + Présence contre le Sangfroid + Résolution. Fait fuir le mortel.');
        $regardterrifiant->setDiscipline($presence);
        $regardterrifiant->setNiveau(3);
        $manager->persist($regardterrifiant);

        $envoutement = new Pouvoir();
        $envoutement->setNom('Envoûtement');
        $envoutement->setDescription('Coût : un test de soif.  Charisme + Présence contre son Sang-froid + Astuce. Envoûte la victime.');
        $envoutement->setDiscipline($presence);
        $envoutement->setNiveau(3);
        $manager->persist($envoutement);

        $convocation = new Pouvoir();
        $convocation->setNom('Convocation');
        $convocation->setDescription('Coût : un test de soif. le personnage doit rester concentré pendant 5 minutes en pensant à la personne qu’il désire invoquer, puis effectuer un jet de Manipulation + Présence en opposition avec son Sang-froid + Intelligence');
        $convocation->setDiscipline($presence);
        $convocation->setNiveau(4);
        $manager->persist($convocation);

        $voiximper = new Pouvoir();
        $voiximper->setNom('Voix impérieuse');
        $voiximper->setDescription('A seulement besoin de parler pour déclencher les pouvoirs de Domination.');
        $voiximper->setDiscipline($presence);
        $voiximper->setNiveau(4);
        $manager->persist($voiximper);

        $magnemedia = new Pouvoir();
        $magnemedia->setNom('Magnétisme médiatique');
        $magnemedia->setDescription('Coût : un test de soif. Révérence, Intimider et Envoûtement fonctionnent à présent sur les enregistrements vidéo et audio en direct.');
        $magnemedia->setDiscipline($presence);
        $magnemedia->setNiveau(5);
        $manager->persist($magnemedia);

        $majeste = new Pouvoir();
        $majeste->setNom('Majesté');
        $majeste->setDescription('Coût : deux test de soif. Les gens en présence du personnage le contemplent bouche bée ou détournent le regard. Charisme + Présence contre Sang-froid + Résolution');
        $majeste->setDiscipline($presence);
        $majeste->setNiveau(5);
        $manager->persist($majeste);

        $bondsurhum = new Pouvoir();
        $bondsurhum->setNom('Bond surhumain');
        $bondsurhum->setDescription('Peut sauter verticalement d’un nombre de mètres égal à trois fois son niveau bondsurhumde Puissance');
        $bondsurhum->setDiscipline($puissance);
        $bondsurhum->setNiveau(1);
        $manager->persist($bondsurhum);

        $corpsletal = new Pouvoir();
        $corpsletal->setNom('Corps létal');
        $corpsletal->setDescription('Peut causer des dégâts aggravés aux mortels avec ses attaques à mains nues.');
        $corpsletal->setDiscipline($puissance);
        $corpsletal->setNiveau(1);
        $manager->persist($corpsletal);

        $prouesse = new Pouvoir();
        $prouesse->setNom('Prouesse');
        $prouesse->setDescription('Coût : un test de soif. Ajoute son niveau de Puissance aux dégâts qu’il cause à mains nues et à ses tours de force, et la moitié (arrondie au supérieur) à ses dégâts de Mêlée');
        $prouesse->setDiscipline($puissance);
        $prouesse->setNiveau(2);
        $manager->persist($prouesse);

        $ingurgmorbide = new Pouvoir();
        $ingurgmorbide->setNom('Ingurgitation brutale');
        $ingurgmorbide->setDescription('Draine le sang d\'un humain en un tour. Inflige 1 dégât par point de soif étanché.');
        $ingurgmorbide->setDiscipline($puissance);
        $ingurgmorbide->setNiveau(3);
        $manager->persist($ingurgmorbide);

        $poigneincroy = new Pouvoir();
        $poigneincroy->setNom('Poigne incroyable');
        $poigneincroy->setDescription('Coût : un test de soif. Réussit automatiquement tous ses jets de compétence pour escalader des surfaces non métalliques.');
        $poigneincroy->setDiscipline($puissance);
        $poigneincroy->setNiveau(3);
        $manager->persist($poigneincroy);

        $etincellerage = new Pouvoir();
        $etincellerage->setNom('Etincelle de rage');
        $etincellerage->setDescription('Coût : un test de soif. il ajoute autant de dés que son niveau de Puissance à tout jet pour inciter une personne ou une assemblée à la violence');
        $etincellerage->setDiscipline($puissance);
        $etincellerage->setNiveau(3);
        $manager->persist($etincellerage);

        $breuvagepuiss = new Pouvoir();
        $breuvagepuiss->setNom('Breuvage de puissance');
        $breuvagepuiss->setDescription('Coût : un test de soif. Le buveur gagne la moitié des points de Puissance du donneur');
        $breuvagepuiss->setDiscipline($puissance);
        $breuvagepuiss->setNiveau(4);
        $manager->persist($breuvagepuiss);

        $frappetellu = new Pouvoir();
        $frappetellu->setNom('Frappe tellurique');
        $frappetellu->setDescription('Coût : deux test de soif. Dextérité + Athlétisme (difficulté 3) pour toutes les personnes autour');
        $frappetellu->setDiscipline($puissance);
        $frappetellu->setNiveau(5);
        $manager->persist($frappetellu);

        $poingdecain = new Pouvoir();
        $poingdecain->setNom('Poing de Caïn');
        $poingdecain->setDescription('Coût : un test de soif. Pendant une scène, le personnage peut infliger des dégâts aggravés aux mortels et aux créatures surnaturelles avec la compétence Bagarre');
        $poingdecain->setDiscipline($puissance);
        $poingdecain->setNiveau(5);
        $manager->persist($poingdecain);

        $poidsplume = new Pouvoir();
        $poidsplume->setNom('Poids plume');
        $poidsplume->setDescription('Si le pouvoir est utilisé en réaction d’Astuce + Survie (difficulté 3). Annule les dégâts de chute');
        $poidsplume->setDiscipline($proteisme);
        $poidsplume->setNiveau(1);
        $manager->persist($poidsplume);

        $yeuxbete = new Pouvoir();
        $yeuxbete->setNom('Yeux de la bête');
        $yeuxbete->setDescription('ignore toutes les pénalités de vue liées à l’obscurité');
        $yeuxbete->setDiscipline($proteisme);
        $yeuxbete->setNiveau(1);
        $manager->persist($yeuxbete);

        $armesbest = new Pouvoir();
        $armesbest->setNom('Armes bestiales');
        $armesbest->setDescription('Coût : un test de soif. +2 aux dégâts de Bagarre.');
        $armesbest->setDiscipline($proteisme);
        $armesbest->setNiveau(2);
        $manager->persist($armesbest);

        $changeforme = new Pouvoir();
        $changeforme->setNom('Change-forme');
        $changeforme->setDescription('Coût : un test de soif. La métamorphose dure un tour et d\'un animal d\'un poids proche du sien');
        $changeforme->setDiscipline($proteisme);
        $changeforme->setNiveau(3);
        $manager->persist($changeforme);

        $fusionterre = new Pouvoir();
        $fusionterre->setNom('Fusion avec la terre');
        $fusionterre->setDescription('Coût : un test de soif. Le vampire se fond dans la terre');
        $fusionterre->setDiscipline($proteisme);
        $fusionterre->setNiveau(3);
        $manager->persist($fusionterre);

        $metamorphose = new Pouvoir();
        $metamorphose->setNom('Métamorphose');
        $metamorphose->setDescription('Coût : un test de soif. Comme le change forme mais le choix d\'animal est libre');
        $metamorphose->setDiscipline($proteisme);
        $metamorphose->setNiveau(4);
        $manager->persist($metamorphose);

        $formebrume = new Pouvoir();
        $formebrume->setNom('Forme de brume');
        $formebrume->setDescription('Coût : un test de soif. Permet de se métamorphoser en brume en trois tour. Peut réduire le nombre de tour avec un test supplémentaire');
        $formebrume->setDiscipline($proteisme);
        $formebrume->setNiveau(5);
        $manager->persist($formebrume);

        $coeursansentrave = new Pouvoir();
        $coeursansentrave->setNom('Coeur sans entrave');
        $coeursansentrave->setDescription('Augmente de +3 la difficulté de tous les jets pour planter un pieu.peut effectuer un test d’Exaltation ainsi qu’un jet de Force + Résolution chaque heure pour retirer un pieu');
        $coeursansentrave->setDiscipline($proteisme);
        $coeursansentrave->setNiveau(5);
        $manager->persist($coeursansentrave);

        $goutdusang = new Pouvoir();
        $goutdusang->setNom('Goût du sang');
        $goutdusang->setDescription('Résolution + Sorcellerie (difficulté 3). Obtient des informations sur le porteur.');
        $goutdusang->setDiscipline($sorcsang);
        $goutdusang->setNiveau(1);
        $manager->persist($goutdusang);

        $vitaecorrosive = new Pouvoir();
        $vitaecorrosive->setNom('Vitae corrosive');
        $vitaecorrosive->setDescription('');
        $vitaecorrosive->setDiscipline($sorcsang);
        $vitaecorrosive->setNiveau(1);
        $manager->persist($vitaecorrosive);

        $eteindrevitae = new Pouvoir();
        $eteindrevitae->setNom('Eteindre la vitae');
        $eteindrevitae->setDescription('Coût : un test de soif. Intelligence + Sorcellerie du sang contre la Vigueur + Sang-froid. Augmente la soif de la cible.');
        $eteindrevitae->setDiscipline($sorcsang);
        $eteindrevitae->setNiveau(2);
        $manager->persist($eteindrevitae);

        $maturationdusang = new Pouvoir();
        $maturationdusang->setNom('Maturation du sang');
        $maturationdusang->setDescription('Coût : un test de soif. Résolution + Sorcellerie difficulté 2+puissance su sang. Donne plus 1 puissance du sang');
        $maturationdusang->setDiscipline($sorcsang);
        $maturationdusang->setNiveau(3);
        $manager->persist($maturationdusang);

        $toucherscorpion = new Pouvoir();
        $toucherscorpion->setNom('Toucher du scorpion');
        $toucherscorpion->setDescription('Coût : un test de soif. Force + Sorcellerie du sang contre Vigueur + Occultisme ou Force d’âme. Inflige autant de dégâts aggravés que de marge de réussite.');
        $toucherscorpion->setDiscipline($sorcsang);
        $toucherscorpion->setNiveau(3);
        $manager->persist($toucherscorpion);

        $volvitae = new Pouvoir();
        $volvitae->setNom('Vol de la vitae');
        $volvitae->setDescription('Coût : un test de soif. Astuce + Sorcellerie du sang contre Astuce + Occultisme. Aspire le sang de la victime à distance.');
        $volvitae->setDiscipline($sorcsang);
        $volvitae->setNiveau(4);
        $manager->persist($volvitae);

        $caressedebaal = new Pouvoir();
        $caressedebaal->setNom('Caresse de baal');
        $caressedebaal->setDescription('Coût : un test de soif. Force + Sorcellerie du sang contre Vigueur + Occultisme ou Force d’âme. Sang de scorpion amélioré. Tue les mortels et inflige des dégâts aggravés aux vampire');
        $caressedebaal->setDiscipline($sorcsang);
        $caressedebaal->setNiveau(5);
        $manager->persist($caressedebaal);

        $chaudrondesang = new Pouvoir();
        $chaudrondesang->setNom('Chaudron de sang');
        $chaudrondesang->setDescription('Coût : un test de soif plus une ou plusieurs flétrissure. Résolution + Sorcellerie du sang contre Sang-froid + Occultisme ou Force d’âme. Tue les mortels, fait gagner un point de soif à un vampire par marge de succés');
        $chaudrondesang->setDiscipline($sorcsang);
        $chaudrondesang->setNiveau(5);
        $manager->persist($chaudrondesang);

        $rituel = new Pouvoir();
        $rituel->setNom('Rituels du sang');
        $rituel->setDescription('Permet au vampire de faire des rituels. Consulter le maitre de jeu.');
        $rituel->setDiscipline($sorcsang);
        $rituel->setNiveau(1);
        $manager->persist($rituel);

        $brouillard = new Pouvoir();
        $brouillard->setNom('Brouillard');
        $brouillard->setDescription('Coût : un test de soif. Créer un brouillard qui suit le lanceur.');
        $brouillard->setDiscipline($alchim);
        $brouillard->setNiveau(1);
        $manager->persist($brouillard);

        $porteeloin = new Pouvoir();
        $porteeloin->setNom('Portée lointaine');
        $porteeloin->setDescription('Coût : un test de soif. Permet de déplacer par la pensée.');
        $porteeloin->setDiscipline($alchim);
        $porteeloin->setNiveau(1);
        $manager->persist($porteeloin);

        $profanhiero = new Pouvoir();
        $profanhiero->setNom('Profanation de la hiérogamie');
        $profanhiero->setDescription('Permet de changer de sexe.');
        $profanhiero->setDiscipline($alchim);
        $profanhiero->setNiveau(1);
        $manager->persist($profanhiero);

        $envelopement = new Pouvoir();
        $envelopement->setNom('Enveloppement');
        $envelopement->setDescription('Permet de créer une brume qui s\'accroche à une victime');
        $envelopement->setDiscipline($alchim);
        $envelopement->setNiveau(2);
        $manager->persist($envelopement);

        $alchimistelvl = new Pouvoir();
        $alchimistelvl->setNom('Le niveau d\'alchimie');
        $alchimistelvl->setDescription('Le niveau d\'alchimie permet de crée des formulae imitant les pouvoirs de niveau -1.');
        $alchimistelvl->setDiscipline($alchim);
        $alchimistelvl->setNiveau(1);
        $manager->persist($alchimistelvl);

        $defractio = new Pouvoir();
        $defractio->setNom('Défractionnement');
        $defractio->setDescription('Permet à un vampire sans estomac d\'acier de digérer pour étancher la soif');
        $defractio->setDiscipline($alchim);
        $defractio->setNiveau(3);
        $manager->persist($defractio);

        $elanaer = new Pouvoir();
        $elanaer->setNom('Elan aérien');
        $elanaer->setDescription('Coût : un test de soif. Permet de planer ou voler à vitesse de course.');
        $elanaer->setDiscipline($alchim);
        $elanaer->setNiveau(4);
        $manager->persist($elanaer);

        $reveildormeur = new Pouvoir();
        $reveildormeur->setNom('Réveiller le dormeur');
        $reveildormeur->setDescription('Permet de sortir un vampire de torpeur.');
        $reveildormeur->setDiscipline($alchim);
        $reveildormeur->setNiveau(5);
        $manager->persist($reveildormeur);

        $addictplus = new AvantageInconvenient();
        $addictplus->setNom('Addiction');
        $addictplus->setDescription('Modifie le nombre de dés selon le dernier sang bu.');
        $addictplus->setType(0);
        $manager->persist($addictplus);

        $apparence = new AvantageInconvenient();
        $apparence->setNom('Apparence');
        $apparence->setDescription('Modifie le nombre de dés sur les jets sociaux');
        $apparence->setType(0);
        $manager->persist($apparence);

        $archa = new AvantageInconvenient();
        $archa->setNom('Archaïque');
        $archa->setDescription('N\'a pas pu ou voulu saisir certains fondamentaux moderne.');
        $archa->setType(-1);
        $manager->persist($archa);

        $liensang = new AvantageInconvenient();
        $liensang->setNom('Lien du sang');
        $liensang->setDescription('Modifie les résistances aux liens su sang.');
        $liensang->setType(0);
        $manager->persist($liensang);

        $linguistique = new AvantageInconvenient();
        $linguistique->setNom('Linguistique');
        $linguistique->setDescription('Illettré');
        $linguistique->setType(-1);
        $manager->persist($linguistique);

        $manducation = new AvantageInconvenient();
        $manducation->setNom('Manducation');
        $manducation->setDescription('Permet de manger mais ne se nourrit pas.');
        $manducation->setType(1);
        $manager->persist($manducation);

        $fleaumyth = new AvantageInconvenient();
        $fleaumyth->setNom('Fléaux mythique');
        $fleaumyth->setDescription('Subit des dégats d\'un fléau venant de mythes.');
        $fleaumyth->setType(-1);
        $manager->persist($fleaumyth);

        $obstaclemyth = new AvantageInconvenient();
        $obstaclemyth->setNom('Obstacle mythique');
        $obstaclemyth->setDescription('Doit dépenser de la volonté face à un obstacle venu d\'un mythe contre les vampire.');
        $obstaclemyth->setType(-1);
        $manager->persist($obstaclemyth);

        $stigmate = new AvantageInconvenient();
        $stigmate->setNom('Stigmates');
        $stigmate->setDescription('A 4 de soif, se met à saigner par des plaies qui sue les mains les pieds et le front.');
        $stigmate->setType(-1);
        $manager->persist($stigmate);

        $empalfatal = new AvantageInconvenient();
        $empalfatal->setNom('Empalement fatal');
        $empalfatal->setDescription('Un pieu dans le coeur est fatal.');
        $empalfatal->setType(-1);
        $manager->persist($empalfatal);

        $traqusang = new AvantageInconvenient();
        $traqusang->setNom('Traqueur sanguin');
        $traqusang->setDescription('Résolution + Vigilance (difficulté 3). Le personnage peut sentir l\'odeur de la résonnance du sang.');
        $traqusang->setType(1);
        $manager->persist($traqusang);

        $estomacfer = new AvantageInconvenient();
        $estomacfer->setNom('Estomac de fer');
        $estomacfer->setDescription('Permet de se nourrir de sang froid rance ou fractionné.');
        $estomacfer->setType(1);
        $manager->persist($estomacfer);

        $soifmathu = new AvantageInconvenient();
        $soifmathu->setNom('Soif du mathusalem');
        $soifmathu->setDescription('Ne peut étancher pleinement sa soif qu\'avec le sang de créatures surnaturelles.');
        $soifmathu->setType(-1);
        $manager->persist($soifmathu);

        $proietaboue = new AvantageInconvenient();
        $proietaboue->setNom('Proie taboue');
        $proietaboue->setDescription('Refuse de se nourrir d\'un type de proie.');
        $proietaboue->setType(-1);
        $manager->persist($proietaboue);

        $vegane = new AvantageInconvenient();
        $vegane->setNom('Végane');
        $vegane->setDescription('Ne se nourrie que de sang animal');
        $vegane->setType(-1);
        $manager->persist($vegane);

        $organophage = new AvantageInconvenient();
        $organophage->setNom('Organophage');
        $organophage->setDescription('Doit dévorer des organes pour étancher sa soif');
        $organophage->setType(-1);
        $manager->persist($organophage);

        $affindiscipline = new AvantageInconvenient();
        $affindiscipline->setNom('Affinité avec une discipline');
        $affindiscipline->setDescription('Octroie une point de discipline hors clan');
        $affindiscipline->setType(1);
        $manager->persist($affindiscipline);

        $apparencevie = new AvantageInconvenient();
        $apparencevie->setNom('Apparence de la vie');
        $apparencevie->setDescription('A un cœur qui bat, peut manger de la nourriture humaine et profite de sa sexualité comme un mortel');
        $apparencevie->setType(1);
        $manager->persist($apparencevie);

        $buveurmatin = new AvantageInconvenient();
        $buveurmatin->setNom('Buveur matinal');
        $buveurmatin->setDescription('La lumière du soleil divise par deux la jauge de santé de votre personnage');
        $buveurmatin->setType(1);
        $manager->persist($buveurmatin);

        $compagnonanarch = new AvantageInconvenient();
        $compagnonanarch->setNom('Compagnons anarchs');
        $compagnonanarch->setDescription('votre personnage s’est rapproché des membres d’une coterie anarch qui tolèrent sa présence');
        $compagnonanarch->setType(1);
        $manager->persist($compagnonanarch);

        $contactcamarilla = new AvantageInconvenient();
        $contactcamarilla->setNom('Contact de la Camarilla');
        $contactcamarilla->setDescription('A attiré l’attention d’un recruteur de la Camarilla');
        $contactcamarilla->setType(1);
        $manager->persist($contactcamarilla);

        $resivamp = new AvantageInconvenient();
        $resivamp->setNom('Résistance vampirique');
        $resivamp->setDescription('Subit des dégâts selon les même règles qu’un vampire normal');
        $resivamp->setType(1);
        $manager->persist($resivamp);

        $sangactif = new AvantageInconvenient();
        $sangactif->setNom('Sang actif');
        $sangactif->setDescription('Peut créer des liens de sang et étreindre des infants comme un vampire normal');
        $sangactif->setType(1);
        $manager->persist($sangactif);

        $sangclairalchimiste = new AvantageInconvenient();
        $sangclairalchimiste->setNom('Sang clair alchimiste');
        $sangclairalchimiste->setDescription('Gagne un point en Alchimie du sang');
        $sangclairalchimiste->setType(1);
        $manager->persist($sangclairalchimiste);

        $chairmorte = new AvantageInconvenient();
        $chairmorte->setNom('Chair morte');
        $chairmorte->setDescription('Le vampire n\'est pas totalement réanimé. Retire un dé à tout jet social en face à face avec un mortel');
        $chairmorte->setType(-1);
        $manager->persist($chairmorte);

        $dentdelait = new AvantageInconvenient();
        $dentdelait->setNom('Dents de lait');
        $dentdelait->setDescription('Ne possède pas de crocs');
        $dentdelait->setType(-1);
        $manager->persist($dentdelait);

        $dependancevitae = new AvantageInconvenient();
        $dependancevitae->setNom('Dépendance à la vitae');
        $dependancevitae->setDescription('Doit boire un point de sang de vampire par semaine. Sinon est dans l\'incapacité d\'utiliser ses pouvoirs vampirique');
        $dependancevitae->setType(-1);
        $manager->persist($dependancevitae);

        $fragilitehumaine = new AvantageInconvenient();
        $fragilitehumaine->setNom('Fragilité humaine');
        $fragilitehumaine->setDescription('Ne peut pas exalter le sang pour se régénérer');
        $fragilitehumaine->setType(-1);
        $manager->persist($fragilitehumaine);

        $maledclan = new AvantageInconvenient();
        $maledclan->setNom('Malédiction de clan');
        $maledclan->setDescription('A un fléaux de clan de niveau 1');
        $maledclan->setType(-1);
        $manager->persist($maledclan);

        $marquecamarilla = new AvantageInconvenient();
        $marquecamarilla->setNom('Marqué par la Camarilla');
        $marquecamarilla->setDescription('La Camarilla vous surveille');
        $marquecamarilla->setType(-1);
        $manager->persist($marquecamarilla);

        $ostracianarch = new AvantageInconvenient();
        $ostracianarch->setNom('Ostraciés par les anarchs');
        $ostracianarch->setDescription('Les anarchs savent qui vous êtes et ne veulent rien avoir à faire avec vous');
        $ostracianarch->setType(-1);
        $manager->persist($ostracianarch);

        $temperamentbestiale = new AvantageInconvenient();
        $temperamentbestiale->setNom('Tempérament bestial');
        $temperamentbestiale->setDescription('Subit la frénésie comme un vampire normal');
        $temperamentbestiale->setType(-1);
        $manager->persist($temperamentbestiale);

        $allie = new AvantageInconvenient();
        $allie->setNom('Allié');
        $allie->setDescription('Mortel qui aide le personnage.');
        $allie->setType(1);
        $manager->persist($allie);

        $contact = new AvantageInconvenient();
        $contact->setNom('Contacts');
        $contact->setDescription('Personne pouvant donner des informations dans son domaine d\'expertise');
        $contact->setType(1);
        $manager->persist($contact);

        $influence = new AvantageInconvenient();
        $influence->setNom('Influence');
        $influence->setDescription('L\'influence et le pouvoir dans la société mortelle');
        $influence->setType(0);
        $manager->persist($influence);

        $masque = new AvantageInconvenient();
        $masque->setNom('Masque');
        $masque->setDescription('L\'avantage ou l\'inconvénient lié à l\'identitée du personnage.');
        $masque->setType(0);
        $manager->persist($masque);

        $mawla = new AvantageInconvenient();
        $mawla->setNom('Mawla');
        $mawla->setDescription('Un vampire ou un groupe de vampire qui veille sur le personnage ou lui en veut.');
        $mawla->setType(0);
        $manager->persist($mawla);

        $refuge = new AvantageInconvenient();
        $refuge->setNom('Refuge');
        $refuge->setDescription('La qualité de l\'endroit où passer le jour');
        $refuge->setType(0);
        $manager->persist($refuge);

        $renomme = new AvantageInconvenient();
        $renomme->setNom('Renommée');
        $renomme->setDescription('Désigne la quantité de personnes connaissant le personnage et leur intérêt.');
        $renomme->setType(0);
        $manager->persist($renomme);

        $ressource = new AvantageInconvenient();
        $ressource->setNom('Ressources');
        $ressource->setDescription('Quantité de bien possédés par le personnage');
        $ressource->setType(0);
        $manager->persist($ressource);

        $servant = new AvantageInconvenient();
        $servant->setNom('Servant');
        $servant->setDescription('Serviteur possédé.');
        $servant->setType(0);
        $manager->persist($servant);

        $troupeau = new AvantageInconvenient();
        $troupeau->setNom('Troupeau');
        $troupeau->setDescription('Groupe de personnes sur qui le personnage peut se nourrir');
        $troupeau->setType(0);
        $manager->persist($troupeau);

        $statut = new AvantageInconvenient();
        $statut->setNom('Statut');
        $statut->setDescription('Réputation et prestige auprès de la communauté vampire locale');
        $statut->setType(0);
        $manager->persist($statut);


        $force = new Attribut();
        $force->setNom('Force');
        $force->setDescription('La puissance brute d\'un personnage.');
        $manager->persist($force);

        $dex = new Attribut();
        $dex->setNom('Dextérité');
        $dex->setDescription('L\'adresse, la vitesse l\'agilité, la coordination.');
        $manager->persist($dex);

        $vigueur = new Attribut();
        $vigueur->setNom('Vigueur');
        $vigueur->setDescription('L\'endurence à la fois physique et mentale.');
        $manager->persist($vigueur);

        $char = new Attribut();
        $char->setNom('Charisme');
        $char->setDescription('La capacité à attirer l\'attention ou à séduire par sa personnalité.');
        $manager->persist($char);

        $manip = new Attribut();
        $manip->setNom('Manipulation');
        $manip->setDescription('La capacité à faire changer d\'avis quelqu\'un.' );
        $manager->persist($manip);

        $sangf = new Attribut();
        $sangf->setNom('Sang-froid');
        $sangf->setDescription('La capacité à rester calme quelque soit la circonstance.');
        $manager->persist($sangf);

        $intel = new Attribut();
        $intel->setNom('Intelligence');
        $intel->setDescription('La capacité à raisonner et mémoriser.');
        $manager->persist($intel);

        $astuce = new Attribut();
        $astuce->setNom('Astuce');
        $astuce->setDescription('L\'habilité mentale, la faculté à trouver des solutions détournée.');
        $manager->persist($astuce);

        $resolu = new Attribut();
        $resolu->setNom('Résolution');
        $resolu->setDescription('Concentration et détermination et représente la capacité d’attention et l’endurance mentale');
        $manager->persist($resolu);


        $armef = new Skill();
        $armef->setNom('Armes à feu');
        $armef->setDescription('La capacité à utiliser les armes à feu');
        $manager->persist($armef);

        $artisanat = new Skill();
        $artisanat->setNom('Artisanat');
        $artisanat->setDescription('L’Artisanat inclut le sens artistique, la création d’objets artistiques comme utilitaires');
        $manager->persist($artisanat);

        $athl = new Skill();
        $athl->setNom('Athlétisme');
        $athl->setDescription('Les capacités athlétiques.');
        $manager->persist($athl);

        $bagar = new Skill();
        $bagar->setNom('Bagarre');
        $bagar->setDescription('La capacité à se battre à main nue.');
        $manager->persist($bagar);

        $conduite = new Skill();
        $conduite->setNom('Conduite');
        $conduite->setDescription('La capacité à conduire un véhicule.');
        $manager->persist($conduite);

        $furtiv = new Skill();
        $furtiv->setNom('Furtivité');
        $furtiv->setDescription('La capacité à ne pas se faire remarquer.');
        $manager->persist($furtiv);

        $larcin = new Skill();
        $larcin->setNom('Larcin');
        $larcin->setDescription('La capacité à faire de petits vols');
        $manager->persist($larcin);

        $melee = new Skill();
        $melee->setNom('Mêlée');
        $melee->setDescription('La capacité à utiliser des armes de mêlée.');
        $manager->persist($melee);

        $survie = new Skill();
        $survie->setNom('Survie');
        $survie->setDescription('Les compétences liées à la survie.');
        $manager->persist($survie);

        $anim = new Skill();
        $anim->setNom('Animaux');
        $anim->setDescription('Les connaissances et l\'affinité avec les animaux.');
        $manager->persist($anim);

        $command = new Skill();
        $command->setNom('Commandement');
        $command->setDescription('Commandement donne au personnage la faculté de mener une foule');
        $manager->persist($command);

        $empath = new Skill();
        $empath->setNom('Empathie');
        $empath->setDescription('La capacité à comprendre, ressentir les émotions ou l\'état d\'esprit de quelqu\'un d\'autre');
        $manager->persist($empath);


        $etiquette = new Skill();
        $etiquette->setNom('Etiquette');
        $etiquette->setDescription('La connaissance des uses et coutumes');
        $manager->persist($etiquette);

        $exprue = new Skill();
        $exprue->setNom('Expérience de la rue');
        $exprue->setDescription('La connaissance et les compétences liées au milieu populaire');
        $manager->persist($exprue);

        $inti = new Skill();
        $inti->setNom('Intimidation');
        $inti->setDescription('La capacité à effrayer quelqu\'un.');
        $manager->persist($inti);

        $persua = new Skill();
        $persua->setNom('Persuasion');
        $persua->setDescription('La capacité à faire changer d\'avis quelqu\'un sans passer par un raisonnement logique.');
        $manager->persist($persua);

        $represent = new Skill();
        $represent->setNom('Représentation');
        $represent->setDescription('Compétence en art de représentation');
        $manager->persist($represent);

        $subter = new Skill();
        $subter->setNom('Subterfuge');
        $subter->setDescription('La capacité à tromper quelqu\'un.');
        $manager->persist($subter);

        $erud = new Skill();
        $erud->setNom('Erudition');
        $erud->setDescription('Les connaissances brute possédée.');
        $manager->persist($erud);


        $finance = new Skill();
        $finance->setNom('Finance');
        $finance->setDescription('Les connaissance et compétences liées au monde de la finance');
        $manager->persist($finance);


        $invest = new Skill();
        $invest->setNom('Investigation');
        $invest->setDescription('Les capacités d\'enquêtes.');
        $manager->persist($invest);


        $med = new Skill();
        $med->setNom('Médecine');
        $med->setDescription('Les connaissances et capacités liées à la médecine.');
        $manager->persist($med);


        $occult = new Skill();
        $occult->setNom('Occultisme');
        $occult->setDescription('Les connaissances liées au surnaturel.');
        $manager->persist($occult);

        $politique = new Skill();
        $politique->setNom('Politique');
        $politique->setDescription('Les connaissances et l\'aisance avec le monde politique.');
        $manager->persist($politique);

        $science = new Skill();
        $science->setNom('Sciences');
        $science->setDescription('Les connaissances et capacités scientifiques.');
        $manager->persist($science);

        $techno = new Skill();
        $techno->setNom('Technologie');
        $techno->setDescription('Les connaissances et capacités technologique');
        $manager->persist($techno);

        $vigilance = new Skill();
        $vigilance->setNom('Vigilance');
        $vigilance->setDescription('La capacité d\'attention constante');
        $manager->persist($vigilance);

        $biberon = new Predateur();
        $biberon->setNom('Biberonneur');
        $biberon->setDescription('Préfère obtenir du sang par tout autre moyen que de chasser.');
        $biberon->addDiscipline($sorcsang);
        $biberon->addAvantageInconvenient($estomacfer);
        $biberon->addAvantageInconvenient($allie);
        $manager->persist($biberon);

        $chatgout = new Predateur();
        $chatgout->setNom('Chat de gouttière');
        $chatgout->setDescription('Le personnage se nourrit par la force, en combattant sa proie');
        $chatgout->setEffetDivers('perd un point d\'humanité');
        $chatgout->setSpecialisation('Intimidation (vol à main armée). Bagarre(lutte).');
        $chatgout->addDiscipline($celerite);
        $chatgout->addDiscipline($puissance);
        $chatgout->addAvantageInconvenient($contact);
        $manager->persist($chatgout);

        $consensualiste = new Predateur();
        $consensualiste->setNom('Consensualiste');
        $consensualiste->setDescription('Le personnage ne boit jamais de sang sans l’accord de sa victime.');
        $consensualiste->setEffetDivers('Gagne un point d\'humanité');
        $consensualiste->setSpecialisation('Médecine (phlébotomie) Persuasion (victime)');
        $consensualiste->addDiscipline($auspex);
        $consensualiste->addDiscipline($forcea);
        $consensualiste->addAvantageInconvenient($renomme);
        $consensualiste->addAvantageInconvenient($proietaboue);
        $manager->persist($consensualiste);

        $fermier = new Predateur();
        $fermier->setNom('Fermier');
        $fermier->setDescription('Le personnage ne se nourrit que sur des animaux.');
        $fermier->setEffetDivers('Gagne un point en humanité');
        $fermier->setSpecialisation('Animaux (un au choix)');
        $fermier->addDiscipline($animalisme);
        $fermier->addDiscipline($proteisme);
        $fermier->addAvantageInconvenient($vegane);
        $manager->persist($fermier);

        $lamproie = new Predateur();
        $lamproie->setNom('Lamproie');
        $lamproie->setDescription('Le personnage se nourrit sur d’autres vampires');
        $lamproie->setEffetDivers('Perd un point d\'humanité et gagne un puissance de sang');
        $lamproie->setSpecialisation('Bagarre (vampire) Furtivité (vampire)');
        $lamproie->addDiscipline($celerite);
        $lamproie->addDiscipline($proteisme);
        $lamproie->addAvantageInconvenient($renomme);
        $lamproie->addAvantageInconvenient($proietaboue);
        $manager->persist($lamproie);

        $marchandsable = new Predateur();
        $marchandsable->setNom('Marchand de sable');
        $marchandsable->setDescription('Le personnage compte sur sa discrétion ou sur ses disciplines pour se nourrir sur des victimes endormies');
        $marchandsable->setSpecialisation('Médecine (anesthésiants) Furtivité (effraction)');
        $marchandsable->addDiscipline($auspex);
        $marchandsable->addDiscipline($occultation);
        $marchandsable->addAvantageInconvenient($ressource);
        $manager->persist($marchandsable);

        $osiris = new Predateur();
        $osiris->setNom('Osiris');
        $osiris->setDescription('Il se nourrit sur ses fans ou sur ses fidèles, qui le traitent comme une divinité.');
        $osiris->setEffetDivers('3 points répartit en Renommé et Troupeau. 2 points en Ennemi ou Mythe et Légende.');
        $osiris->setSpecialisation('Occultisme (une tradition en particulier) ou Représentation (un domaine)');
        $osiris->addDiscipline($sorcsang);
        $osiris->addDiscipline($presence);
        $manager->persist($osiris);

        $parasite = new Predateur();
        $parasite->setNom('Parasite domestique');
        $parasite->setDescription('Le personnage se nourrit en cachette sur sa famille et ses amis mortels');
        $parasite->setSpecialisation('Persuasion (emotion) ou Subterfuge (mensonge de couverture)');
        $parasite->addDiscipline($domination);
        $parasite->addDiscipline($animalisme);
        $parasite->addAvantageInconvenient($renomme);
        $parasite->addAvantageInconvenient($troupeau);
        $manager->persist($parasite);

        $reinenuit = new Predateur();
        $reinenuit->setNom('Reine de la nuit');
        $reinenuit->setDescription('Le personnage compte sur sa connaissance intime d’une sous-culture en particulier et sur une posture soigneusement travaillée pour se nourrir sur les membres de cette sousculture exclusive.');
        $reinenuit->setSpecialisation('Etiquette/Commandement/Expérience de la rue (une sous culture spécifique).');
        $reinenuit->addDiscipline($domination);
        $reinenuit->addDiscipline($puissance);
        $reinenuit->addAvantageInconvenient($renomme);
        $reinenuit->addAvantageInconvenient($contact);
        $reinenuit->addAvantageInconvenient($influence);
        $reinenuit->addAvantageInconvenient($proietaboue);
        $manager->persist($reinenuit);

        $succube = new Predateur();
        $succube->setNom('Succube');
        $succube->setDescription('Le personnage se nourrit presque exclusivement pendant les relations sexuelles ou en feignant d’en avoir');
        $succube->setSpecialisation('Persuasion (séduction) ou Subterfuge (séduction).');
        $succube->addDiscipline($forcea);
        $succube->addDiscipline($presence);
        $succube->addAvantageInconvenient($apparence);
        $succube->addAvantageInconvenient($allie);
        $manager->persist($succube);

        $manager->flush();
    }
}
