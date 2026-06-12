# VS Code: Guía Rápida (5 Minutos)

## ¿Qué necesitas?

✅ Visual Studio Code instalado
✅ Git instalado
✅ Cuenta GitHub

---

## Paso 1: Clonar el Repositorio (2 minutos)

### Si NO tienes la carpeta del proyecto:

**Opción A: Terminal/PowerShell (FÁCIL)**

```bash
# 1. Abre PowerShell o Terminal
# 2. Navega a tu carpeta de proyectos
cd C:\Users\TuNombre\Proyectos

# 3. Clona
git clone https://github.com/alem248/MarketPlacePlus.git

# 4. Entra en carpeta
cd MarketPlacePlus

# 5. Abre VS Code
code .
```

**Opción B: VS Code GUI**

1. Ctrl + Shift + P
2. Escribe: `Git: Clone`
3. Pega: `https://github.com/alem248/MarketPlacePlus.git`
4. Selecciona carpeta
5. ¡Listo!

---

## Paso 2: Obtener los Cambios (2 minutos)

### Terminal (RECOMENDADO):

```bash
# Descarga todo del servidor
git fetch --all

# Ve a la rama con los cambios
git checkout code-cleanup-and-inactivation

# Trae los cambios
git pull origin code-cleanup-and-inactivation
```

### VS Code GUI:

1. **Ctrl + Shift + G** (Control de Fuente)
2. Click los **3 puntos** (...) → **Fetch**
3. Click **nombre de rama** (esquina inferior) → busca **code-cleanup-and-inactivation**
4. Click los **3 puntos** (...) → **Pull**

---

## Paso 3: Verificar que Tienes Todo ✅

### Checklist Visual:

```
✅ Esquina inferior izquierda muestra:
   "code-cleanup-and-inactivation"

✅ En el Explorer (Ctrl + B) ves estos archivos:
   • TECHNICAL_DOCUMENTATION.md
   • QUICK_REFERENCE.md
   • REFACTORING_SUMMARY.md
   • DOCUMENTATION_INDEX.md
   • VSCODE_SYNC_GUIDE.md

✅ Control de Fuente (Ctrl + Shift + G) muestra 7+ archivos modificados
```

### Terminal Check:

```bash
git status
# Debe decir: "On branch code-cleanup-and-inactivation"
#             "Your branch is up to date"

git log --oneline -3
# Debe mostrar los cambios recientes
```

---

## Paso 4: Leer la Documentación (1 minuto)

**OPCIÓN A: Empieza AHORA (5 min)**
- Abre en VS Code: `QUICK_REFERENCE.md`
- Lee todo, es rápido

**OPCIÓN B: Si tienes 45 minutos**
- Abre: `TECHNICAL_DOCUMENTATION.md`
- Entenderás TODO

**OPCIÓN C: No sé qué leer**
- Abre: `DOCUMENTATION_INDEX.md`
- Te dice qué leer según tu rol

---

## Atajos que Necesitas Saber

| Atajo | Qué hace |
|-------|----------|
| **Ctrl + Shift + G** | Ver cambios (Control de Fuente) |
| **Ctrl + `` ` `` | Abrir terminal |
| **Ctrl + F** | Buscar en archivo |
| **Ctrl + P** | Ir a archivo rápido |
| **Ctrl + R** | Refrescar ventana |

---

## Comandos Terminal que Necesitas

```bash
# VER ESTADO
git status

# DESCARGAR CAMBIOS
git fetch --all
git pull origin code-cleanup-and-inactivation

# CAMBIAR RAMA
git checkout code-cleanup-and-inactivation

# SI HICISTE CAMBIOS Y QUIERES SUBIRLOS
git add .
git commit -m "Tu mensaje"
git push origin code-cleanup-and-inactivation
```

---

## Problemas Comunes

### "No veo los cambios"
```bash
git pull origin code-cleanup-and-inactivation
# Espera, luego en VS Code: Ctrl + R
```

### "No veo la rama code-cleanup-and-inactivation"
```bash
git fetch --all
# Espera 10 segundos
# Ctrl + Shift + P → Git: Checkout
```

### "Hice cambios por accidente"
**En VS Code:**
- Control de Fuente (Ctrl + Shift + G)
- Click derecho en archivo
- "Discard Changes"

---

## RESUMEN EN UNA FRASE

```
git clone ... → git fetch --all → git checkout code-cleanup-and-inactivation → git pull → listo
```

---

## ¿Listo?

1. ✅ Terminal o VS Code
2. ✅ Sigue pasos arriba
3. ✅ Abre `QUICK_REFERENCE.md`
4. ✅ ¡A trabajar!

---

## Extras: Ver los Cambios

### Ver qué cambió en un archivo:

1. Control de Fuente (Ctrl + Shift + G)
2. Click en archivo
3. Verás lado izquierdo = antes, lado derecho = después

### Ver historial:

1. Abre archivo
2. Lado izquierdo → TIMELINE
3. Haz click en cada commit

### Ver en GitHub:

https://github.com/alem248/MarketPlacePlus/tree/code-cleanup-and-inactivation

---

**¡Necesitas ayuda? Lee VSCODE_SYNC_GUIDE.md (la guía completa)**
