<?php
$file = 'nativephp/android/app/src/main/java/com/nativephp/mobile/ui/MainActivity.kt';
$content = file_get_contents($file);

$splashTextOriginal = '    @Composable
    private fun SplashText() {
        Column(
            modifier = Modifier.fillMaxSize(),
            horizontalAlignment = Alignment.CenterHorizontally,
            verticalArrangement = Arrangement.Center
        ) {
            val iconId = remember {
                try {
                    resources.getIdentifier("splash_logo", "drawable", packageName)
                } catch (e: Exception) { 0 }
            }
            if (iconId != 0) {
                Image(painter = painterResource(id = iconId), contentDescription = null)
            }
            Text(
                text = "Loading…",
                fontSize = 16.sp,
                modifier = Modifier.padding(bottom = 64.dp)
            )
        }
    }';

$splashTextNew = '    @Composable
    private fun SplashText() {
        Column(
            modifier = Modifier.fillMaxSize(),
            horizontalAlignment = Alignment.CenterHorizontally,
            verticalArrangement = Arrangement.Center
        ) {
            val iconId = remember {
                try {
                    resources.getIdentifier("splash_logo", "drawable", packageName)
                } catch (e: Exception) { 0 }
            }
            if (iconId != 0) {
                Image(
                    painter = painterResource(id = iconId),
                    contentDescription = "App Icon",
                    modifier = Modifier.size(100.dp).padding(bottom = 24.dp)
                )
            }
            
            Text(
                text = "Sanatan Brahmacharya",
                fontSize = 28.sp,
                fontWeight = androidx.compose.ui.text.font.FontWeight.Bold,
                color = Color.Black
            )
            Text(
                text = "ब्रह्मचर्य ही जीवन है",
                fontSize = 16.sp,
                color = Color(0xFF333333),
                modifier = Modifier.padding(top = 12.dp)
            )
        }
    }';

$content = str_replace($splashTextOriginal, $splashTextNew, $content);
file_put_contents($file, $content);
echo "Fixed";
