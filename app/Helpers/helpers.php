<?php


function enumValues($cases): array
{
    return array_column($cases, "value");
}
