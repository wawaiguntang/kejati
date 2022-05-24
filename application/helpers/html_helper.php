<?php
function AbstractHTMLContents($html, $maxLength = 100)
{
    mb_internal_encoding("UTF-8");
    $printedLength = 0;
    $position = 0;
    $tags = array();
    $newContent = '';

    $html = $content = preg_replace("/<img[^>]+\>/i", "", $html);

    while ($printedLength < $maxLength && preg_match('{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}', $html, $match, PREG_OFFSET_CAPTURE, $position)) {
        list($tag, $tagPosition) = $match[0];
        // Print text leading up to the tag.
        $str = mb_strcut($html, $position, $tagPosition - $position);
        if ($printedLength + mb_strlen($str) > $maxLength) {
            $newstr = mb_strcut($str, 0, $maxLength - $printedLength);
            $newstr = preg_replace('~\s+\S+$~', '', $newstr);
            $newContent .= $newstr;
            $printedLength = $maxLength;
            break;
        }
        $newContent .= $str;
        $printedLength += mb_strlen($str);
        if ($tag[0] == '&') {
            // Handle the entity.
            $newContent .= $tag;
            $printedLength++;
        } else {
            // Handle the tag.
            $tagName = $match[1][0];
            if ($tag[1] == '/') {
                // This is a closing tag.
                $openingTag = array_pop($tags);
                assert($openingTag == $tagName); // check that tags are properly nested.
                $newContent .= $tag;
            } else if ($tag[mb_strlen($tag) - 2] == '/') {
                // Self-closing tag.
                $newContent .= $tag;
            } else {
                // Opening tag.
                $newContent .= $tag;
                $tags[] = $tagName;
            }
        }

        // Continue after the tag.
        $position = $tagPosition + mb_strlen($tag);
    }

    // Print any remaining text.
    if ($printedLength < $maxLength && $position < mb_strlen($html)) {
        $newstr = mb_strcut($html, $position, $maxLength - $printedLength);
        $newstr = preg_replace('~\s+\S+$~', '', $newstr);
        $newContent .= $newstr;
    }

    // Close any open tags.
    while (!empty($tags)) {
        $newContent .= sprintf('</%s>', array_pop($tags));
    }

    return $newContent;
}
