<?php namespace Jehaby\Kindle;


class HighlightsCollectionFactory {


    public function makeCollection($file_content)
    {
        if (is_array($file_content)) {
            return new HighlightsCollection($file_content);
        }

        $this->parser = new ClippingsParser($file_content);
        return $this->parser->getCollection();
    }



}