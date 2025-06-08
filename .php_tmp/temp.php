<?php
// Your original function
function replaceLinks($text){
    $pattern = '/(https?:\/\/[^\s]+)/';
    $replacement = '<a href="$1" target="_blank">$1</a>';
    $newText = preg_replace($pattern, $replacement, $text);
    return $newText;
}

// Enhanced debug function
function debugReplaceLinks($text) {
    echo "<h3>🔍 Debug Analysis</h3>\n";
    echo "<p><strong>Input text:</strong> '" . htmlspecialchars($text) . "'</p>\n";
    echo "<p><strong>Text length:</strong> " . strlen($text) . "</p>\n";
    
    // Show each character with its code
    echo "<p><strong>Character analysis:</strong><br>";
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $code = ord($char);
        echo htmlspecialchars($char) . " (ASCII: $code) ";
    }
    echo "</p>\n";
    
    $pattern = '/(https?:\/\/[^\s]+)/';
    
    // Test if pattern matches
    if (preg_match($pattern, $text, $matches)) {
        echo "<p>✅ <strong>Pattern matches!</strong></p>\n";
        echo "<p><strong>Full match:</strong> '" . htmlspecialchars($matches[0]) . "'</p>\n";
        echo "<p><strong>Match length:</strong> " . strlen($matches[0]) . "</p>\n";
    } else {
        echo "<p>❌ <strong>Pattern does NOT match</strong></p>\n";
    }
    
    // Test preg_replace
    $result = preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', $text);
    echo "<p><strong>preg_replace result:</strong> '" . htmlspecialchars($result) . "'</p>\n";
    
    // Check for preg_replace errors
    $error = preg_last_error();
    if ($error !== PREG_NO_ERROR) {
        echo "<p>❌ <strong>preg_replace error code:</strong> $error</p>\n";
    } else {
        echo "<p>✅ <strong>No preg_replace errors</strong></p>\n";
    }
    
    return $result;
}

// Test cases
$testCases = [
    "https://www.creative-tim.com/twcomponents/cheatsheet",
    "Check out https://www.creative-tim.com/twcomponents/cheatsheet for info",
    "Visit https://example.com now"
];

foreach ($testCases as $i => $test) {
    echo "<div style='border: 1px solid #ccc; margin: 10px; padding: 10px;'>\n";
    echo "<h2>Test Case " . ($i + 1) . "</h2>\n";
    
    $result = debugReplaceLinks($test);
    
    echo "<h4>Final Result:</h4>\n";
    echo "<p><strong>Original function output:</strong><br>" . replaceLinks($test) . "</p>\n";
    echo "<p><strong>Are they the same?</strong> " . ($result === replaceLinks($test) ? "✅ Yes" : "❌ No") . "</p>\n";
    echo "</div>\n";
}

// Additional test - maybe it's a PHP version issue?
echo "<h3>PHP Environment Info:</h3>\n";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>\n";
echo "<p><strong>PCRE Version:</strong> " . (defined('PCRE_VERSION') ? PCRE_VERSION : 'Not available') . "</p>\n";
?>