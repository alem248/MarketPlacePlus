# Guía Completa: Sincronizar Cambios en Visual Studio Code

## Índice
1. [Preparación Inicial](#preparación-inicial)
2. [Clonar el Repositorio](#clonar-el-repositorio)
3. [Sincronizar Cambios](#sincronizar-cambios)
4. [Revisar Cambios en VS Code](#revisar-cambios-en-vs-code)
5. [Trabajar con las Ramas](#trabajar-con-las-ramas)
6. [Fusionar Cambios a Main](#fusionar-cambios-a-main)
7. [Solución de Problemas](#solución-de-problemas)
8. [Atajos de Teclado Útiles](#atajos-de-teclado-útiles)

---

## Preparación Inicial

### Requisitos Previos
```
✅ Visual Studio Code instalado
✅ Git instalado en tu máquina
✅ Acceso a GitHub (cuenta y credenciales)
✅ Carpeta para el proyecto (ejemplo: ~/Projects)
```

### Verificar Instalación
```bash
# Verificar Git
git --version
# Resultado esperado: git version 2.x.x

# Verificar acceso a GitHub
git clone --depth 1 https://github.com/alem248/MarketPlacePlus.git test-clone
rm -rf test-clone
# Debe funcionar sin errores de autenticación
```

---

## Clonar el Repositorio

### Opción 1: Desde Terminal/PowerShell (RECOMENDADO)

```bash
# Paso 1: Navega a tu carpeta de proyectos
cd ~/Projects
# O en Windows:
cd C:\Users\TuUsuario\Projects

# Paso 2: Clona el repositorio
git clone https://github.com/alem248/MarketPlacePlus.git

# Paso 3: Entra a la carpeta
cd MarketPlacePlus

# Paso 4: Verifica las ramas disponibles
git branch -a
# Deberías ver:
# * main
#   code-cleanup-and-inactivation
#   remotes/origin/code-cleanup-and-inactivation
#   remotes/origin/main

# Paso 5: Descarga todos los cambios del servidor
git fetch --all

# Paso 6: Cambia a la rama con los cambios
git checkout code-cleanup-and-inactivation
# Resultado: "Switched to branch 'code-cleanup-and-inactivation'"
```

### Opción 2: Desde VS Code

#### 2.1 Abrir Comando de Paleta
```
Windows/Linux: Ctrl + Shift + P
macOS: Cmd + Shift + P
```

#### 2.2 Buscar y Ejecutar
```
Escribe: "Git: Clone"
Presiona: Enter
Pega URL: https://github.com/alem248/MarketPlacePlus.git
Selecciona: Carpeta destino
Presiona: Enter
VS Code abrirá automáticamente la carpeta clonada
```

---

## Sincronizar Cambios

### Cuando Ya Tienes el Repositorio Clonado

#### Opción 1: Desde Terminal
```bash
# En la carpeta del proyecto

# Paso 1: Descarga todos los cambios del servidor
git fetch --all

# Paso 2: Verifica el estado actual
git status
# Resultado esperado: "On branch code-cleanup-and-inactivation"

# Paso 3: Si estás en main, cambia a la rama correcta
git checkout code-cleanup-and-inactivation

# Paso 4: Actualiza a la última versión
git pull origin code-cleanup-and-inactivation
```

#### Opción 2: Desde VS Code (Interfaz Gráfica)

**Pasos visuales en VS Code:**

1. **Abre el Control de Fuente** (Sidebar izquierdo)
   - Click en el icono de rama o presiona `Ctrl + Shift + G`

2. **Sincroniza cambios**
   - Click en los 3 puntos (...) en la parte superior
   - Selecciona "Pull"
   - Espera a que termine (barra en la esquina inferior derecha)

3. **Cambia de rama**
   - Click en el nombre de la rama (esquina inferior izquierda)
   - Busca: "code-cleanup-and-inactivation"
   - Click para seleccionar

---

## Revisar Cambios en VS Code

### 1. Ver Rama Actual
**Ubicación:** Esquina inferior izquierda de VS Code
```
Muestra: "code-cleanup-and-inactivation"
Click: Para cambiar de rama
```

### 2. Ver Árbol de Archivos Modificados

**Control de Fuente (Ctrl + Shift + G):**
```
CHANGES (Cambios)
├── Modified (Modificados)
│   ├── app/Http/Controllers/Admin/AdminProductController.php
│   ├── app/Http/Controllers/Admin/BannerController.php
│   ├── app/Models/User.php
│   ├── app/Models/Product.php
│   ├── app/Models/Banner.php
│   ├── app/Models/Comment.php
│   ├── app/Models/Trato.php
│   ├── resources/views/admin/dashboard.blade.php
│   └── resources/views/admin/banners/index.blade.php
├── Staged Changes
│   └── (Archivos que serán committeados)
└── Merged Changes
    └── (Cambios fusionados)
```

### 3. Ver Diferencia de Código (Diff)

**Pasos:**

1. **Abre Control de Fuente** (Ctrl + Shift + G)

2. **Selecciona un archivo modificado**
   - Click en: `app/Models/User.php`

3. **Se abrirá una vista de diferencia:**
   ```
   Lado izquierdo:  Código original (antes)
   Lado derecho:    Código nuevo (después)
   
   Líneas rojas:    Código eliminado
   Líneas verdes:   Código agregado
   ```

4. **Navega diferencias:**
   - Arriba del archivo hay flechas: ⬆️ ⬇️
   - Haz click para ir de un cambio a otro

### 4. Ver Historial de Cambios

**Opción A: Desde Control de Fuente**
1. Click en **TIMELINE** (abajo del explorer)
2. Verás todos los commits en orden cronológico
3. Click en cada commit para ver qué cambió

**Opción B: Desde un archivo específico**
1. Abre un archivo (ejemplo: `User.php`)
2. Click derecho en el nombre de la pestaña
3. Selecciona: "Open in Git History"
4. Verás el historial de cambios de ese archivo

---

## Trabajar con las Ramas

### Cambiar Entre Ramas

```bash
# Desde terminal
git checkout main
git checkout code-cleanup-and-inactivation

# O equivalente moderno
git switch main
git switch code-cleanup-and-inactivation
```

**Desde VS Code:**
1. Click en nombre de rama (esquina inferior izquierda)
2. Selecciona la rama del dropdown
3. Presiona Enter

### Crear Nueva Rama (para tu propio trabajo)

```bash
# Desde terminal
git checkout -b mi-nueva-rama code-cleanup-and-inactivation
```

**Desde VS Code:**
1. Click en nombre de rama (esquina inferior izquierda)
2. Selecciona: "Create new branch"
3. Nombra tu rama: `mi-nueva-rama`
4. Selecciona rama base: `code-cleanup-and-inactivation`

---

## Fusionar Cambios a Main

### ⚠️ IMPORTANTE: Proceso Recomendado

**OPCIÓN A: Hacer Pull Request en GitHub (RECOMENDADO)**

1. **En tu navegador, ve a GitHub:**
   ```
   https://github.com/alem248/MarketPlacePlus
   ```

2. **Selecciona la rama:**
   - Click en el dropdown "main" o "code-cleanup-and-inactivation"
   - Elige: `code-cleanup-and-inactivation`

3. **Crea Pull Request:**
   - GitHub detectará cambios
   - Click en: "Compare & pull request"
   - Añade título y descripción
   - Click en: "Create pull request"

4. **Revisa y Aprueba:**
   - Revisa los cambios en la pestaña "Files changed"
   - Si todo está bien, click en: "Merge pull request"
   - Confirma fusión

5. **Actualiza tu código local:**
   ```bash
   git checkout main
   git pull origin main
   ```

**OPCIÓN B: Fusionar Desde Terminal**

```bash
# Paso 1: Cambia a main
git checkout main

# Paso 2: Asegúrate que main está actualizado
git pull origin main

# Paso 3: Fusiona code-cleanup-and-inactivation
git merge code-cleanup-and-inactivation

# Paso 4: Sube los cambios
git push origin main
```

**OPCIÓN C: Fusionar Desde VS Code (Menos recomendado)**

1. Control de Fuente (Ctrl + Shift + G)
2. Click en los 3 puntos (...)
3. Selecciona: "Merge Branch"
4. Elige: `code-cleanup-and-inactivation`
5. Click en "Merge"

---

## Verificar que los Cambios Estén Correctamente Sincronizados

### Checklist Visual en VS Code

```
✅ Verificar rama correcta
   └─ Esquina inferior izquierda muestra: "code-cleanup-and-inactivation"

✅ Verificar archivos descargados
   └─ Control de Fuente → CHANGES
   └─ Deberías ver 7+ archivos modificados

✅ Verificar documentación
   └─ En el Explorer (Ctrl + B)
   └─ Deberías ver estos archivos en raíz:
      • TECHNICAL_DOCUMENTATION.md
      • QUICK_REFERENCE.md
      • REFACTORING_SUMMARY.md
      • DOCUMENTATION_INDEX.md
      • VSCODE_SYNC_GUIDE.md

✅ Verificar modelos modificados
   └─ Abre: app/Models/User.php
   └─ Busca (Ctrl + F): "suspend"
   └─ Deberías ver métodos nuevos

✅ Verificar migraciones
   └─ Abre: database/migrations
   └─ Deberías ver: 2026_06_12_140000_add_is_active_to_users_table.php
   └─ NO deberías ver: 2026_06_12_131051_add_suspension_reason_to_products_table.php

✅ Verificar vista actualizada
   └─ Abre: resources/views/admin/dashboard.blade.php
   └─ Busca (Ctrl + F): "block"
   └─ Deberías ver icono "block" en lugar de "delete"
```

### Desde Terminal (Verificación Completa)

```bash
# Ver estado de rama
git status
# Resultado: "On branch code-cleanup-and-inactivation"
#            "Your branch is up to date with 'origin/code-cleanup-and-inactivation'"

# Ver últimos commits
git log --oneline -5
# Resultado: Deberías ver 5 commits recientes

# Ver archivos modificados en la rama
git diff main..code-cleanup-and-inactivation --name-only
# Resultado: Lista de archivos cambiad

# Ver cambios específicos
git show code-cleanup-and-inactivation:app/Models/User.php | grep -A 5 "suspend"
# Resultado: Métodos suspend() y reactivate()
```

---

## Solución de Problemas

### Problema 1: "No puedo cambiar de rama - hay cambios pendientes"

```bash
# Opción A: Guarda tus cambios en un "stash"
git stash

# Ahora cambia de rama
git checkout code-cleanup-and-inactivation

# Cuando regreses, recupera tus cambios
git stash pop

# Opción B: Descarta cambios locales
git checkout -- .
# Luego cambia de rama
git checkout code-cleanup-and-inactivation
```

### Problema 2: "Los cambios no se ven en VS Code"

```bash
# Paso 1: Descarga cambios del servidor
git fetch --all

# Paso 2: Verifica qué rama estás
git branch
# Deberías ver un * al lado de tu rama actual

# Paso 3: Cambia a la rama correcta
git checkout code-cleanup-and-inactivation

# Paso 4: Actualiza a la última versión
git pull origin code-cleanup-and-inactivation

# Paso 5: En VS Code, presiona F5 para refrescar
# O recarga VS Code: Ctrl + R
```

### Problema 3: "Los archivos .md no se ven en VS Code"

```bash
# Los archivos podrían no estar sincronizados
# Solución:

# Opción A: Desde terminal
git pull origin code-cleanup-and-inactivation

# Opción B: Desde VS Code
# 1. Ctrl + Shift + G (Control de Fuente)
# 2. Click en los 3 puntos (...)
# 3. Selecciona "Pull"

# Opción C: Recarga VS Code
# Ctrl + R o cierra y abre VS Code
```

### Problema 4: "Mi rama está diferente a la del servidor"

```bash
# Ver diferencia
git diff origin/code-cleanup-and-inactivation code-cleanup-and-inactivation

# Opción 1: Fuerza a coincidir con el servidor (CUIDADO)
git reset --hard origin/code-cleanup-and-inactivation

# Opción 2: Trae cambios del servidor sin perder tu trabajo
git pull origin code-cleanup-and-inactivation
```

### Problema 5: "No veo la rama code-cleanup-and-inactivation"

```bash
# Paso 1: Descarga todas las ramas del servidor
git fetch --all

# Paso 2: Verifica ramas disponibles
git branch -a
# Deberías ver:
# * main
#   code-cleanup-and-inactivation
#   remotes/origin/code-cleanup-and-inactivation
#   remotes/origin/main

# Paso 3: Crea rama local basada en remota
git checkout --track origin/code-cleanup-and-inactivation

# Paso 4: Verifica que estés en la rama correcta
git branch
```

---

## Atajos de Teclado Útiles en VS Code

### Git y Control de Versiones

| Acción | Windows/Linux | macOS |
|--------|---------------|-------|
| Abrir Control de Fuente | `Ctrl + Shift + G` | `Cmd + Shift + G` |
| Abrir Comando (Paleta) | `Ctrl + Shift + P` | `Cmd + Shift + P` |
| Buscar en archivo | `Ctrl + F` | `Cmd + F` |
| Buscar en proyecto | `Ctrl + Shift + F` | `Cmd + Shift + F` |
| Reemplazar en archivo | `Ctrl + H` | `Cmd + Option + F` |
| Abrir archivo | `Ctrl + P` | `Cmd + P` |
| Ver diferencia (diff) | `Click en archivo + D` | `Click en archivo + D` |
| Ir a línea | `Ctrl + G` | `Cmd + G` |
| Terminal integrada | `Ctrl + `` | `Cmd + `` |
| Refrescar ventana | `Ctrl + R` | `Cmd + R` |

### Comandos Útiles en Paleta (Ctrl + Shift + P)

```
Git: Sync             → Sincroniza cambios
Git: Fetch            → Descarga cambios del servidor
Git: Pull             → Trae cambios del servidor
Git: Push             → Sube cambios al servidor
Git: Checkout         → Cambia de rama
Git: Create Branch    → Crea nueva rama
Git: Delete Branch    → Elimina rama
Git: Merge Branch     → Fusiona ramas
Git: View History     → Ve historial de cambios
Git: Undo Last Commit → Deshace último commit
```

---

## Flujo Típico de Trabajo Diario

### Mañana (inicio de sesión)

```bash
# 1. Abre VS Code
# 2. Abre terminal (Ctrl + `)
# 3. Ejecuta:
git fetch --all
git pull origin code-cleanup-and-inactivation

# 4. Verifica rama correcta (esquina inferior izquierda)
# 5. Comienza a trabajar
```

### Durante el día (mientras trabajas)

```bash
# Cada vez que hagas cambios importantes:

# 1. Guarda archivos (Ctrl + S)
# 2. Abre Control de Fuente (Ctrl + Shift + G)
# 3. Revisa cambios
# 4. Escribe mensaje de commit
# 5. Click en checkmark o:
git add .
git commit -m "Tu mensaje descriptivo"
```

### Final de día (antes de salir)

```bash
# 1. Abre terminal (Ctrl + `)
# 2. Verifica estado:
git status

# 3. Si hay cambios, commitea:
git add .
git commit -m "Cambios finales del día"

# 4. Sube al servidor:
git push origin code-cleanup-and-inactivation

# 5. Verifica en GitHub que se subió
```

### Cuando listo para fusionar (después de revisar)

```bash
# 1. Abre terminal
# 2. Verifica que estés en la rama correcta:
git branch

# 3. Si todo está bien, crea Pull Request en GitHub
# 4. O fusiona desde terminal:
git checkout main
git pull origin main
git merge code-cleanup-and-inactivation
git push origin main
```

---

## Extensiones Recomendadas para VS Code

Para mejor experiencia con Git:

### Extensión 1: GitLens
- **Propósito:** Ver historial de cambios línea por línea
- **Instalación:** 
  - Abre Extensions (Ctrl + Shift + X)
  - Busca: "GitLens"
  - Click en "Install"
- **Uso:** Pasa mouse sobre una línea de código, ve quién la escribió y cuándo

### Extensión 2: GitHub Pull Requests and Issues
- **Propósito:** Manejar Pull Requests desde VS Code
- **Instalación:**
  - Abre Extensions (Ctrl + Shift + X)
  - Busca: "GitHub Pull Requests and Issues"
  - Click en "Install"
- **Uso:** Ver, crear y fusionar PRs sin abrir GitHub

### Extensión 3: Git Graph
- **Propósito:** Visualizar árbol de commits
- **Instalación:**
  - Abre Extensions (Ctrl + Shift + X)
  - Busca: "Git Graph"
  - Click en "Install"
- **Uso:** Click en icono de rama (lado izquierdo), verás gráfico visual

---

## Referencia Rápida: Comandos Terminal

```bash
# DESCARGAR CAMBIOS
git fetch --all                              # Descarga todo
git pull origin code-cleanup-and-inactivation # Trae cambios

# CAMBIAR RAMA
git checkout code-cleanup-and-inactivation   # Cambia rama
git branch                                   # Ver rama actual
git branch -a                                # Ver todas las ramas

# VER CAMBIOS
git status                                   # Estado actual
git log --oneline -10                        # Últimos 10 commits
git diff                                     # Ver cambios no comitteados
git diff branch-name                         # Diferencia entre ramas

# GUARDAR TRABAJO
git add .                                    # Prepara archivos
git commit -m "mensaje"                      # Guarda cambios
git push origin code-cleanup-and-inactivation # Sube al servidor

# FUSIONAR
git checkout main                            # Cambia a main
git pull origin main                         # Actualiza main
git merge code-cleanup-and-inactivation      # Fusiona rama
git push origin main                         # Sube cambios
```

---

## Cheat Sheet: Secuencia Completa (desde cero)

```bash
# PRIMER INTENTO: Clonar y preparar
git clone https://github.com/alem248/MarketPlacePlus.git
cd MarketPlacePlus
git fetch --all
git checkout code-cleanup-and-inactivation
code .  # Abre VS Code

# VERIFICAR QUE TODO ESTÁ
git status  # Debe decir "On branch code-cleanup-and-inactivation"
ls *.md     # Debe mostrar los 4 archivos .md

# HACER CAMBIOS (TU TRABAJO)
# Edita archivos en VS Code
git status              # Ver qué cambió
git diff archivo.php    # Ver cambios específicos
git add .               # Prepara cambios
git commit -m "Mi cambio"  # Comitea

# SINCRONIZAR CON SERVIDOR
git fetch --all         # Descarga cambios del servidor
git pull origin code-cleanup-and-inactivation  # Trae cambios
git push origin code-cleanup-and-inactivation  # Sube tus cambios

# FUSIONAR A MAIN (CUANDO ESTÉ LISTO)
git checkout main
git pull origin main
git merge code-cleanup-and-inactivation
git push origin main

# LIMPIAR
git checkout code-cleanup-and-inactivation  # Vuelve a rama de desarrollo
git branch -d rama-temporal  # Elimina rama si no la necesitas
```

---

## Resumen: Lo más Importante

✅ **Clona:** `git clone <url>`
✅ **Descarga:** `git fetch --all` + `git pull`
✅ **Cambia rama:** `git checkout code-cleanup-and-inactivation`
✅ **Ve cambios:** Control de Fuente (Ctrl + Shift + G)
✅ **Crea commits:** `git add .` + `git commit -m "mensaje"`
✅ **Sube:** `git push origin code-cleanup-and-inactivation`
✅ **Fusiona:** GitHub Pull Request o `git merge`

¡Listo! Ahora puedes trabajar correctamente con los cambios en VS Code.
